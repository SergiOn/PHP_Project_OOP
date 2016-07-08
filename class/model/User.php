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
    public function getAllUser() {
        $idUser = $this->getUserId();
        $allUser = $this->db->sendQuery("SELECT user_data.*, subscribes.idUser, subscribes.idAuthor 
                                         FROM `user_data` LEFT JOIN `subscribes` 
                                         ON user_data.id = subscribes.idAuthor
                                         AND subscribes.idUser = $idUser
                                         ORDER BY `user_data`.`id` ASC");
        return $allUser;
    }
    public function subsAction($idUser, $status) {
        $myId = $this->getUserId();
        if ($status === "delete") {
            $result = $this->db->delete("subscribes", ["idUser"=>$myId, "idAuthor"=>$idUser]);
            return $result;
        } elseif ($status === "insert") {
            $result = $this->db->insert("subscribes", ["idUser"=>$myId, "idAuthor"=>$idUser]);
            return $result;
        }
    }
    public function getCity() {
        $city = $this->db->select("city");
        return $city;
    }
    public function addCity($city) {
        if (!$city) return false;
        $result = $this->db->select("city", false, ["name"=>$city]);
        if (!empty($result)) return false;
        $resultInsert = $this->db->insert("city", ["name"=>$city]);
        if ($resultInsert) {
            return true;
        } else {
            return false;
        }
    }
    public function login($email = "", $pass = "", $check = false) {
        $user = $this->db->select("user_login", false, ["email" => $email, "pass" => md5($pass)])[0];
        if (!empty($user) && $check) {
            setcookie("auth", $email, time()+60*60*24, "/");
            setcookie("token", md5("security_key".$email), time()+60*60*24, "/");
            return true;
        } elseif (!empty($user)) {
            if (session_status() == PHP_SESSION_NONE) session_start();
            $_SESSION['auth'] = $email;
            $_SESSION['token'] = md5("security_key".$email);
            return true;
        } else {
            return false;
        }
    }
    public function logout() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (isset($_SESSION['auth']) || isset($_SESSION['token'])) {
            unset($_SESSION['auth']);
            unset($_SESSION['token']);
            session_destroy();
        }
        if (isset($_COOKIE['auth']) || isset($_COOKIE['token'])) {
            setcookie("auth", "", time()-1, "/");
            setcookie("token", "", time()-1, "/");
        }
        return true;
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

    public function getLoginStatus() {
        if (isset($_COOKIE['auth'])) {
            $user = $this->getUserExist($_COOKIE['auth']);
            if ($user) return true;
        }
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (isset($_SESSION['auth'])) {
            $user = $this->getUserExist($_SESSION['auth']);
            if ($user) return true;
        }
        return false;
    }
    public function getTrueUser() {
        if (isset($_COOKIE['auth']) && isset($_COOKIE['token'])) {
            $email = $_COOKIE['auth'];
            $token = md5("security_key".$email);
            if ($_COOKIE['token'] === $token) {
                return true;
            }
        }
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (isset($_SESSION['auth']) && isset($_SESSION['token'])) {
            $email = $_SESSION['auth'];
            $token = md5("security_key".$email);
            if ($_SESSION['token'] === $token) {
                return true;
            }
        }
        return false;
    }
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

    public function getTrueUser();
}