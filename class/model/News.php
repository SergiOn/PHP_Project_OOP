<?php
/**
 * Created by PhpStorm.
 * User: Sergio
 * Date: 10.05.2016
 * Time: 16:45
 */

namespace model;


use core\Model;

class News extends Model{
    public function getAll() {
        $allNews = $this->db->sendQuery("SELECT articles.*, user_data.name, user_data.l_name, user_data.avatar 
                                         FROM `articles` LEFT JOIN `user_data` ON articles.idUser = user_data.id
                                         ORDER BY `articles`.`id` ASC");
        return $allNews;
    }
    public function getMy() {
        $id = $this->getUserId();
        $myNews = $this->db->sendQuery("SELECT articles.*, user_data.name, user_data.l_name, user_data.avatar 
                                        FROM `articles` LEFT JOIN `user_data` ON articles.idUser = user_data.id
                                        WHERE articles.idUser = $id
                                        ORDER BY `articles`.`id` ASC");
        return $myNews;
    }
    public function subscribe() {
        $id = $this->getUserId();
        $subscribe = $this->db->sendQuery("SELECT articles.*, user_data.name, user_data.l_name, user_data.avatar 
                                           FROM `articles` LEFT JOIN `user_data` ON articles.idUser = user_data.id
                                           WHERE `idUser` IN (SELECT `idAuthor` FROM `subscribes` WHERE `idUser` = $id)");
        return $subscribe;
    }
    public function comments() {
        $comments = $this->db->sendQuery("SELECT `comments`.*, `user_data`.name, `user_data`.l_name, `user_data`.avatar 
                                          FROM `comments` LEFT JOIN `user_data` ON comments.idUser = user_data.id ORDER BY id");
        return $comments;
    }
    public function addNewNews() {
        $idUser = $this->getUserId();
        $idArticle = $this->db->insert("articles",
            [
                "title" => $_POST['title'],
                "text" => $_POST['articletext'],
                "idUser" => $idUser
            ]);
        $cover = $_FILES['cover'];
        if ($cover['name']) {
            $nameCover = $cover['name'];
            $nameIdCover = preg_replace("/[a-z0-9-_]+\.([a-z0-9]+)/i", "$idArticle.$1", $nameCover);
            $tmp_name = $cover['tmp_name'];
            copy($tmp_name, "images/articles/".$nameIdCover);
            $imageLink = "images/articles/".$nameIdCover;
            $this->db->update("articles", ["image" => $imageLink], ["id" => $idArticle]);
        }
        return $idArticle;
    }
    public function getTrueAuthor($idNews) {
        if (!$idNews) return false;
        $idUser = $this->getUserId();
        $authorArticle = $this->db->select("articles", ["idUser"], ["id" => $idNews])[0]["idUser"];
        return $authorArticle === $idUser ? true : false;
    }
    public function deleteNews($idNews) {
        $imgLink = $this->db->select("articles", ["image"], ["id" => $idNews]);
        if (!empty($imgLink) && file_exists($imgLink[0]["image"])) unlink($imgLink[0]["image"]);
        $result = $this->db->delete("articles", ["id" => $idNews]);
        return $result;
    }
    public function getModifyNews($idNews) {
        $dataNews = $this->db->select("articles", false, ["id" => $idNews])[0];
        return $dataNews;
    }
    public function modifyNews($idNews) {
        $title = $_POST['title'];
        $text = $_POST['articletext'];
        $createDate = date("Y-m-j H:i:s");
        $cover = $_FILES['cover'];

        if (isset($_POST['savepic'])) {
            $result = $this->db->update(
                "articles",
                ["title" => $title, "text" => $text, "createDate" => $createDate],
                ["id" => $idNews]
            );
        } elseif ($cover['name']) {
            $imgLink = $this->db->select("articles", ["image"], ["id" => $idNews]);
            if (!empty($imgLink) && file_exists($imgLink[0]["image"])) unlink($imgLink[0]["image"]);
            $nameCover = $cover['name'];
            $nameIdCover = preg_replace("/[a-z0-9-_]+\.([a-z0-9]+)/i", "$idNews.$1", $nameCover);
            $tmp_name = $cover['tmp_name'];
            copy($tmp_name, "images/articles/" . $nameIdCover);
            $imageLink = "images/articles/".$nameIdCover;
            $result = $this->db->update(
                "articles",
                ["title" => $title, "text" => $text, "createDate" => $createDate, "image" => $imageLink],
                ["id" => $idNews]
            );
        } else {
            $imgLink = $this->db->select("articles", ["image"], ["id" => $idNews]);
            if (!empty($imgLink) && file_exists($imgLink[0]["image"])) unlink($imgLink[0]["image"]);
            $result = $this->db->update(
                "articles",
                ["title" => $title, "text" => $text, "createDate" => $createDate, "image" => null],
                ["id" => $idNews]
            );
        }
        return $result;
    }
    public function addComment() {
        $idUser = $this->getUserId();
        $result = $this->db->insert(
            "comments",
            ["text" => $_POST['text'], "idUser" => $idUser, "idArticles" => $_POST['idArticle']]
        );
        return $result;
    }
}