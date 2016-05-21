<?php
/**
 * Created by PhpStorm.
 * User: Sergio
 * Date: 10.05.2016
 * Time: 12:30
 */

namespace core;


class Model {
    protected $db;

    public function __construct() {
        $this->db = new \core\DB();
    }
    
    public function getUserId() {
        if (isset($_COOKIE['auth'])) {
            $email = $_COOKIE['auth'];
            $userId = $this->db->select("user_login", ["id"], ["email"=>$email])[0]["id"];
            return $userId;
        }
        session_start();
        if (isset($_SESSION['auth'])) {
            $email = $_SESSION['auth'];
            $userId = $this->db->select("user_login", ["id"], ["email"=>$email])[0]["id"];
            return $userId;
        }
        return false;
    }

}