<?php
/**
 * Created by PhpStorm.
 * User: Sergio
 * Date: 09.05.2016
 * Time: 1:33
 */

#preg_match_all
//preg_match_all("/(.*project-oop\/).*/i", $_SERVER["REQUEST_URI"], $nameSite);
//$nameSite = $nameSite[1][0];

#preg_replace
$nameSite = preg_replace("/(.*project-oop\/).*/i", "$1", $_SERVER["REQUEST_URI"]);

#$_SERVER["REQUEST_URI"];
define("SITE", $nameSite);


function __autoload($className) {
    $className = preg_replace("/\\\\/", "/", $className);
    $path = "class/$className.php";
    if(file_exists($path)) {
        include_once($path);
    }
}


