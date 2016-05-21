<?php
/**
 * Created by PhpStorm.
 * User: Sergio
 * Date: 10.05.2016
 * Time: 22:27
 */

namespace controller;


use core\Controller;


class User extends Controller {
    public $viewMain;

    public function __construct() {
        $this->model = new \model\User();
        $this->view = new \view\User();
        $this->viewMain = new \view\Main();
    }

    public function index() {
        $this->allUsers();
    }
    public function allUsers() {
        $allUser = $this->model->getAllUser();
        $id = $this->model->getUserId();
        $this->view->allUsers($allUser, $id);
    }
    public function addCity() {
        $this->view->addCity();
    }
    public function loginUser() {
        $this->view->loginUser();
    }
    public function registrationUser() {
        $city = $this->model->getCity();
        $this->view->registrationUser($city);
    }

    public function addCityAction() {
        header("refresh: 3, url = ".SITE."user/addCity");
        $result = $this->model->addCity($_POST['city']);
        if ($result) {
            $this->viewMain->good("The city added to the database");
        } else {
            $this->viewMain->problem("The city has not been added to the database");
        }
    }
    public function authAction() {
        $this->model->logout();
        $enabledCookie = $_POST['check'] ? true : false;
        $result = $this->model->login($_POST['email'], $_POST['pass'], $enabledCookie);
        if ($result) {
            header("Location: ".SITE."main/welcome");
        } else {
            header("refresh: 5, url = ".SITE);
            $this->viewMain->problem("User does not exist");
        }
    }
    public function quitAction() {
        $result =  $this->model->logout();
        if ($result) {
            header("refresh: 5, url = ".SITE);
            $this->viewMain->bye("You have successfully exited");
        } else {
            header("refresh: 5, url = ".SITE);
            $this->viewMain->problem("Any problems with exited");
        }
    }
    public function regAction() {
        $this->model->logout();
        $user = $this->model->getUserExist($_POST['email']);
        if (!empty($user)) {
            header("refresh: 5, url = ".SITE."user/registrationUser");
            $this->viewMain->problem("User with that email exists");
            return;
        }
        if ($_POST['pass'] !== $_POST['confirmPass']) {
            header("refresh: 5, url = ".SITE."user/registrationUser");
            $this->viewMain->problem("Passwords do not match");
            return;
        }
        if (!$_POST['pass'] || !$_POST['confirmPass']) {
            header("refresh: 5, url = ".SITE."user/registrationUser");
            $this->viewMain->problem("You forgot passwords");
            return;
        }
        $enabledCookie = $_POST['check'] ? true : false;

        $resultReg = $this->model->registrUser(
            $_POST['email'],
            $_POST['pass'],
            $_POST['name'],
            $_POST['l_name'],
            $_POST['phone'],
            $_POST['birthdate'],
            $_POST['city'],
            $_FILES['avatar']
        );
        if (!$resultReg) {
            header("refresh: 5, url = ".SITE."user/registrationUser");
            $this->viewMain->problem("We had some problems during registration");
            return;
        }
        $resultLogin = $this->model->login($_POST['email'], $_POST['pass'], $enabledCookie);
        if ($resultLogin) {
            header("Location: ".SITE."main/welcome");
        } else {
            header("refresh: 5, url = ".SITE."user/loginUser");
            $this->viewMain->problem("Registration complete. But user does not exist");
        }
    }
    public function subsAction() {
        $this->model->subsAction($_GET['id'], $_GET['status']);
        header("Location: ".SITE."user");
    }
}