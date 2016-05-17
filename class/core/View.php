<?php
/**
 * Created by PhpStorm.
 * User: Sergio
 * Date: 10.05.2016
 * Time: 12:41
 */

namespace core;


class View {
    public static function loadStaticPageAnd($pageInclude = false, $var = false, $var2 = false) {
        include_once "templates/static/head.php";
        include_once "templates/static/menu.php";

        if ($pageInclude && is_string($pageInclude)) {
            include_once $pageInclude;
        } elseif ($pageInclude && is_array($pageInclude)) {
            foreach ($pageInclude as $value) {
                include_once $value;
            }
        }
        include_once "templates/static/footer.php";
    }
}