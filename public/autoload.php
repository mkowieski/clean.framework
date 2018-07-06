<?php
/**
 * Created by Mirosław Kowieski
 * Date: 2018-07-06 19:22
 */

class NotFoundException extends Exception {}
class RouterFileNotFoundException extends Exception {}

function load($class) {
    $file = str_replace("\\", "/", $class) . ".php";
    $path = "../$file";
    if (!file_exists($path))
        throw new NotFoundException("File doesn't exists.");

    include_once $path;
}

spl_autoload_register('load');