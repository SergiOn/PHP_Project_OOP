<?php
/**
 * Created by PhpStorm.
 * User: User17
 * Date: 04.05.16
 * Time: 19:27
 */

namespace controller;


use core\Controller;

class Main extends Controller {
    public function __construct() {
        $this->view = new \view\Main();
    }

    public function index() {
        if (User::getTrueUser()) header("Location: ".SITE."main/welcome");
        $this->startPage();
    }
    
    public function startPage() {
        $this->view->startPage();
    }
    public function welcome () {
        User::getTrueUser();
        $this->view->welcome();
    }
    public function pageNotFound() {
        $this->view->pageNotFound();
    }
}