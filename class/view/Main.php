<?php
/**
 * Created by PhpStorm.
 * User: Sergio
 * Date: 10.05.2016
 * Time: 19:29
 */

namespace view;


class Main {
    public function startPage() {
        \core\View::loadStaticPageAnd("templates/main.php");
    }
    public function welcome() {
        \core\View::loadStaticPageAnd("templates/welcome.php");
    }
    public function pageNotFound() {
        \core\View::loadStaticPageAnd("templates/result/pageNotFound.php");
    }
    public function problem($someText) {
        \core\View::loadStaticPageAnd("templates/result/problem.php", $someText);
    }
    public function bye() {
        \core\View::loadStaticPageAnd("templates/result/bye.php");
    }
    public function good($someText) {
        \core\View::loadStaticPageAnd("templates/result/good.php", $someText);
    }
}