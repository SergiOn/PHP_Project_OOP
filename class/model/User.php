<?php
/**
 * Created by PhpStorm.
 * User: Sergio
 * Date: 14.05.2016
 * Time: 18:26
 */

namespace model;


use core\Model;

class User extends Model implements UserInterface, ProfInterface {
    public function getCity() {
        $city = $this->db->select("city");
        return $city;
    }

    public function login($email = "", $pass = "", $check = false) {
        $user = $this->db->select("user_login", false, ["email" => $email, "pass" => md5($pass)])[0];
        if (!empty($user) && $check) {
            setcookie("auth", $email, time()+60*60*24, "/");
            setcookie("token", md5("security_key".$email), time()+60*60*24, "/");
            return true;
        } elseif (!empty($user)) {
            session_start();
            $_SESSION['auth'] = $email;
            $_SESSION['token'] = md5("security_key".$email);
            return true;
        } else {
            return false;
        }
    }
    public function logout() {
        session_start();
        if (isset($_SESSION['auth']) || isset($_SESSION['token'])) {
            session_destroy();
            return true;
        }
        if (isset($_COOKIE['auth']) || isset($_COOKIE['token'])) {
            setcookie("auth", "", time()-1, "/");
            setcookie("token", "", time()-1, "/");
            return true;
        }
        if (empty($_SESSION) && empty($_COOKIE)) {
            return true;
        } else {
            return false;
        }
    }
    public function registrUser($email = "", $pass = "", $name = "", $surname = "", $phone = "", $birthdate = "", $city = "", $avatar = "") {
        $id = $this->db->insert("user_login", ["email"=>$email,"pass"=>md5($pass)]);
        if (!$id) return false;

        if ($avatar['name']) {
            $nameAvatar = $avatar['name'];
            $nameIdAvatar = preg_replace("/[a-z0-9]+\.([a-z0-9]+)/i", "$id.$1", $nameAvatar);
            $tmp_name = $avatar['tmp_name'];
            copy($tmp_name, "images/idUsers/".$nameIdAvatar);
            $avatarLink = "images/idUsers/".$nameIdAvatar;
        } else {
            $avatarLink = "";
        }
        $this->db->insert("user_data", [
            "id"=>$id,
            "idCity"=>$city,
            "name"=>$name,
            "l_name"=>$surname,
            "avatar"=>$avatarLink,
            "phone"=>$phone,
            "birthdate"=>$birthdate
        ]);
        $result = $this->db->select("user_data", ["id"], ["id"=>$id, "name"=>$name, "l_name"=>$surname])[0]["id"];
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function getUserExist($email = "") {
        $user = $this->db->select("user_login", ["id"], ["email" => $email])[0];
        if ($user) {
            return true;
        } else {
            return false;
        }
    }


    public function getLoginStatus()
    {
        // TODO: Implement getLoginStatus() method.
    }
//    public static function getTrueUser()
//    {
//        // TODO: Implement getTrueUser() method.
//    }
    public static function getTrueUser() {
        $email = $_COOKIE['auth'];
        $token = md5("security_key".$email);
        if ($_COOKIE['token'] === $token) {
            return true;
        } else {
            return false;
        }
    }
//    public function getLoginStatus() {
//        if ($_COOKIE['auth'] && $_COOKIE['token']) {
//            return true;
//        } else {
//            return false;
//        }
//    }
}


interface UserInterface {
    /**
     * метод має логінити юзера, створюючи два значення куккі
     * auth - email user
     * token - md5("security_key".email_user)
     *
     * @param string $email - емейл юзера
     * @param string $pass - пароль юзера (не в md5)
     * @return mixed - має повертати true якщо вдалось залогінитись
     * та код помилки, якщо виникла помилка
     */
    public function login($email = "",$pass = "");

    /**
     * метод має очищати кукі, які створюються при реєстрації
     *
     * @return mixed - має повернути true, якщо вихід відбувся вдало
     */
    public function logout();

    /**
     * @param string $email - mail
     * @param string $pass - password (not md5)
     * @param string $name - name new user
     * @param string $surname - surname new user
     * @return mixed - must return true if registration is successful
     */
    public function registrUser($email = "", $pass = "", $name = "", $surname = "");
}
interface ProfInterface {
    public function getLoginStatus();

    /**
     * @param string $email - email user
     * @return mixed
     */
    public function getUserExist($email = "");

    public static function getTrueUser();
}