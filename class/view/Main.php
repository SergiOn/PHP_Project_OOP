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
    public function pageNotFound() {
        \core\View::loadStaticPageAnd("templates/pageNotFound.php");
    }
    public function welcome() {
        \core\View::loadStaticPageAnd("templates/welcome.php");
    }
    public function problem($someText) {
        \core\View::loadStaticPageAnd("templates/problem.php", $someText);
    }
    public function bye($someText) {
        \core\View::loadStaticPageAnd("templates/bye.php", $someText);
    }
}