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
    public function __construct() {
        $this->model = new \model\News();
        $this->view = new \view\News();
    }
    
    public function index() {
        $this->getAll();
    }
    public function getAll() {
        $id = $this->model->getUserId();
        $allNews = $this->model->getAll();
        $this->view->showNews($allNews, $id);
    }
    public function getMy() {
        $id = $this->model->getUserId();
        $myNews = $this->model->getMy();
        $this->view->showNews($myNews, $id);
    }
    public function addNews() {
        $this->view->addNews();
    }
    public function subscribe() {
        $id = $this->model->getUserId();
        $subscribe = $this->model->subscribe();
        $this->view->showNews($subscribe, $id);
    }

    public function newsAction() {
        print_r($_POST);
    }

    public function apiGetAll() {
        $allNews = $this->model->getAll();
        echo $jsonAllNews = json_encode($allNews);
    }
}