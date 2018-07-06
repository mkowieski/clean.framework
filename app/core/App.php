<?php

/**
 * Created by Mirosław Kowieski
 * Date: 2018-07-06 19:20
 */

namespace app\core;

use Zend\Http\Request;

class App
{
    private $router;

    private $controller;

    private $method;

    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->controller = $router->getController();
        $this->method = $router->getMethod();
    }

    public function run()
    {
        if (!class_exists("app\\controller\\{$this->controller}"))
            throw new \ControllerNotFoundException();

        $this->controller = "app\\controller\\{$this->controller}";
        $this->controller = new $this->controller();

        if (!method_exists($this->controller, $this->method))
            throw new \MethodNotFoundException();


        call_user_func([$this->controller, $this->method], new Request());
    }
}