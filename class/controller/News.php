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
        $allNews = $this->model->getAll();
        $this->view->getAll($allNews);
    }
    public function getMy() {
        $myNews = $this->model->getMy();
        $this->view->getMy($myNews);
    }
    public function addNews() {
        $this->view->addNews();
    }
    public function subscribe() {
        $subscribe = $this->model->subscribe();
        $this->view->showSubscribe($subscribe);
    }

    public function apiGetAll() {
        $allNews = $this->model->getAll();
        echo $jsonAllNews = json_encode($allNews);
    }
}