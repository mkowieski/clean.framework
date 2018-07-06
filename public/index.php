<?php
/**
 * Created by Mirosław Kowieski
 * Date: 2018-07-06 19:18
 */

use app\core\App;
use app\core\Router;

require_once "../vendor/autoload.php";
require_once "globals.php";
require_once "autoload.php";

$app = new App(new Router());
$app->run();
