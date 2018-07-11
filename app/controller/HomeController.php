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
    public function indexAction(Request $request, $test, $dwa)
    {
        // @TODO check request

        print_r($test);
        print_r($dwa);

        $view = new View();
        $view->setLayout("test");

        return $view->render("home.index");
    }
}