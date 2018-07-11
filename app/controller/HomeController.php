<?php
/**
 * Created by Mirosław Kowieski
 * Date: 2018-07-06 19:19
 */

namespace app\controller;

use app\core\View;
use Zend\Http\Request;

class HomeController
{
    public function indexAction(Request $request)
    {
        // @TODO check request

        $view = new View();

        return $view->render("home.index");
    }
}