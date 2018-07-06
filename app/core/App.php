<?php

/**
 * Created by Mirosław Kowieski
 * Date: 2018-07-06 19:20
 */

namespace app\core;

class App
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }


    public function run()
    {

    }
}