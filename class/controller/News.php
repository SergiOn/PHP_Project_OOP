<?php
/**
 * Created by PhpStorm.
 * User: Sergio
 * Date: 09.05.2016
 * Time: 20:05
 */

namespace controller;

use core\Controller;

class News extends Controller {
    public $viewMain;

    public function __construct() {
        $this->model = new \model\News();
        $this->view = new \view\News();
        $this->viewMain = new \view\Main();
        User::getTrueUser();
    }
    
    public function index() {
        $this->getAll();
    }
    public function getAll() {
        $id = $this->model->getUserId();
        $allNews = $this->model->getAll();
        $comments = $this->comments();
        $this->view->showNews($allNews, $id, $comments);
    }
    public function getMy() {
        $id = $this->model->getUserId();
        $myNews = $this->model->getMy();
        $comments = $this->comments();
        $this->view->showNews($myNews, $id, $comments);
    }
    public function subscribe() {
        $id = $this->model->getUserId();
        $subscribe = $this->model->subscribe();
        $comments = $this->comments();
        $this->view->showNews($subscribe, $id, $comments);
    }
    protected function comments() {
        $comments = $this->model->comments();
        return $comments;
    }
    public function addNews() {
        $this->view->addNews();
    }
    public function modifyNews() {
        $idNews = $_GET['modifyArticleId'];
        $isAuthor = $this->model->getTrueAuthor($idNews);
        if (!$isAuthor) {
            header("refresh: 3, url = ".SITE."news/getMy");
            $this->viewMain->problem("You are not the author of this article");
            return;
        }
        $dataNews = $this->model->getModifyNews($idNews);
        $this->view->modifyNews($dataNews);
    }

    public function newsAction() {
        if ($_POST && !$_POST['submit']) {
            $result = $this->model->addNewNews();
            if ($result) {
                header("refresh: 2, url = ".SITE."news/getMy");
                $this->viewMain->good("The news is added");
            } else {
                header("refresh: 3, url = ".SITE."news/addNews");
                $this->viewMain->problem("The news is not added");
            }
        } elseif ($_POST && $_POST['submit']) {
            $idNews = $_POST['submit'];
            $isAuthor = $this->model->getTrueAuthor($idNews);
            if (!$isAuthor) {
                header("refresh: 3, url = ".SITE."news/getMy");
                $this->viewMain->problem("You are not the author of this article");
                return;
            }
            $result = $this->model->modifyNews($idNews);
            if ($result) {
                header("refresh: 1, url = ".SITE."news/getMy");
                $this->viewMain->good("The article modify");
            } else {
                header("refresh: 3, url = ".SITE."news/getMy");
                $this->viewMain->problem("The article did not modify");
            }
        } elseif (isset($_GET['deleteArticleId'])) {
            $idNews = $_GET['deleteArticleId'];
            $isAuthor = $this->model->getTrueAuthor($idNews);
            if (!$isAuthor) {
                header("refresh: 3, url = ".SITE."news/getMy");
                $this->viewMain->problem("You are not the author of this article");
                return;
            }
            $result = $this->model->deleteNews($idNews);
            if ($result) {
                header("refresh: 1, url = ".SITE."news/getMy");
                $this->viewMain->good("The article deleted");
            } else {
                header("refresh: 3, url = ".SITE."news/getMy");
                $this->viewMain->problem("The article did not delete");
            }
        } else {
            $this->viewMain->pageNotFound();
        }
    }

    public function commentAction() {
        $result = $this->model->addComment();
        if ($result) {
            header("Location: ".$_SERVER['HTTP_REFERER']);
        };
    }

    public function apiGetAll() {
        $allNews = $this->model->getAll();
        echo $jsonAllNews = json_encode($allNews);
    }
}