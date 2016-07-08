<?php
/**
 * Created by PhpStorm.
 * User: Sergio
 * Date: 10.05.2016
 * Time: 16:45
 */

namespace view;


class News {
    public function showNews($news, $id, $comments) {
        \core\View::loadStaticPageAnd("templates/news.php", $news, $id, $comments);
    }
    public function addNews() {
        \core\View::loadStaticPageAnd("templates/addNews.php");
    }
    public function modifyNews($dataNews) {
        \core\View::loadStaticPageAnd("templates/modifyNews.php", $dataNews);
    }
}