<?php
/**
 * Created by PhpStorm.
 * User: User17
 * Date: 04.05.16
 * Time: 19:27
 */

namespace controller;


use core\Controller;
use \PDO;

class Main extends Controller {
    public function __construct() {
        $this->view = new \view\Main();
    }

    public function index() {
        $this->startPage();
    }
    
    public function startPage() {
        $this->view->startPage();
    }
    public function welcome () {
        $this->view->welcome();
    }
    public function pageNotFound() {
        $this->view->pageNotFound();
    }

    public function comments() {
        $settings = "mysql:host=localhost;dbname=OnischenkoBD";
        try {
            $db = new \PDO($settings, "root", "");
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $sql = "SELECT articles.*, comments.text, comments.idUser, comments.idArticles, comments.createDate 
                FROM `articles` LEFT JOIN `comments` 
                ON articles.idUser = comments.idUser";
        $query = $db->prepare($sql);
        $query->execute();
        $array = $query->fetchAll(PDO::FETCH_ASSOC);

        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
}