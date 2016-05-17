<?php
/**
 * Created by PhpStorm.
 * User: User17
 * Date: 04.05.16
 * Time: 19:16
 */

namespace core;


abstract class Controller {
    public $model;
    public $view;

    public function __construct (){
        if (User::getTrueUser()) {

        }
    }

    abstract function index();
}