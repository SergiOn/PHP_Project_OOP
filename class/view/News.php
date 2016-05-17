<?php
/**
 * Created by PhpStorm.
 * User: Sergio
 * Date: 10.05.2016
 * Time: 16:45
 */

namespace view;


class News {
    public function getAll($news) {
        \core\View::loadStaticPageAnd("templates/news.php", $news);
    }
    public function getMy($news) {
        \core\View::loadStaticPageAnd("templates/news.php", $news);
    }
    public function addNews() {
        \core\View::loadStaticPageAnd("templates/addNews.php");
    }
    public function showSubscribe($news) {
        \core\View::loadStaticPageAnd("templates/news.php", $news);
    }
}