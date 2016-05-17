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
        $allNews = $this->db->select("articles");
        return $allNews;
    }
    public function getMy() {
        $user = "1";
        $myNews = $this->db->select("articles", false, ["idUser"=>$user]);
        return $myNews;
    }
    public function subscribe() {
        $author = "1";
        $subscribe = $this->db->select("articles", false, ["idUser"=>$author]);
        return $subscribe;
    }
}