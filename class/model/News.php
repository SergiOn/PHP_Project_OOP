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
}