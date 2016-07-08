<?php
/**
 * Created by PhpStorm.
 * User: Sergio
 * Date: 09.05.2016
 * Time: 19:58
 */

namespace core;

class Routing {
    protected static function getPath() {
        $path = $_SERVER["REQUEST_URI"];
        $pathArr = explode("/", $path);
        $pathArrSITE = explode("/", SITE);

        $classNum = count($pathArrSITE) - 1;
        $methodNum = count($pathArrSITE);
        $className = false;
        $methodName = false;
        if (isset($pathArr[$classNum])) {
            $className = $pathArr[$classNum];
        }
        if (isset($pathArr[$methodNum])) {
            $methodName = $pathArr[$methodNum];
            $methodName = preg_replace("/\?.*/", "", $methodName);
        }
        $result = [$className, $methodName];
        return $result;
    }

    public static function rout() {
        $arr = self::getPath();
        $className = $arr[0] ? ucfirst($arr[0]) : "Main";
        $methodName = $arr[1] ? $arr[1] : "index";
        $className = "\\controller\\".$className;

        if (class_exists($className)) {
            $obj = new $className;
            if (method_exists($obj, $methodName)) {
                $obj->$methodName();
            } else {
                $obj = new \controller\Main();
                $obj->pageNotFound();
            }
        } else {
            $obj = new \controller\Main();
            $obj->pageNotFound();
        }
    }
}