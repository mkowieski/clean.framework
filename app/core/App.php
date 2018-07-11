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

    private $params = [];

    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->controller = $router->getController();
        $this->method = $router->getMethod();
        $this->params = $router->getParams();
    }

    public function run()
    {
        if (!class_exists("app\\controller\\{$this->controller}"))
            throw new \ControllerNotFoundException();

        $this->controller = "app\\controller\\{$this->controller}";
        $this->controller = new $this->controller();

        if (!method_exists($this->controller, $this->method))
            throw new \MethodNotFoundException();

        array_unshift($this->params, new Request());

        call_user_func_array([$this->controller, $this->method], $this->params);
    }
}