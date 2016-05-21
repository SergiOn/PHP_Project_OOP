<?php
/**
 * Created by PhpStorm.
 * User: Sergio
 * Date: 10.05.2016
 * Time: 22:28
 */

namespace view;


class User {
    public function allUsers($allUser, $id) {
        \core\View::loadStaticPageAnd("templates/allUsers.php", $allUser, $id);
    }
    public function addCity() {
        \core\View::loadStaticPageAnd("templates/addCity.php");
    }

    public function loginUser() {
        \core\View::loadStaticPageAnd("templates/login.php");
    }
    public function registrationUser($city) {
        \core\View::loadStaticPageAnd("templates/registration.php", $city);
    }
}