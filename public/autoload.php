<?php
/**
 * Created by Mirosław Kowieski
 * Date: 2018-07-06 19:22
 */

class NotFoundException extends Exception {}
class RouterFileNotFoundException extends NotFoundException {}
class RouteNotFoundException extends NotFoundException {}
class InvalidRouteMethodException extends NotFoundException {}
class ControllerNotFoundException extends NotFoundException {}
class MethodNotFoundException extends NotFoundException {}

function load($class) {
    $file = str_replace("\\", "/", $class) . ".php";
    $path = "../$file";
    if (!file_exists($path))
        throw new NotFoundException("Class $path doesn't exists.");

    include_once $path;
}

spl_autoload_register('load');