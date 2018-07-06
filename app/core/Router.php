<?php

/**
 * Created by Mirosław Kowieski
 * Date: 2018-07-06 19:19
 */

namespace app\core;

class Router
{

    const PATH_WEB_ROUTERS = "router\\web.php";
    const PATH_API_ROUTERS = "router\\api.php";
    const PATH_CONSOLE_ROUTERS = "router\\console.php";

    const CONSOLE_SESSION_NAME = "Console";

    const WEB_SESSION = "WEB";
    const API_SESSION = "API";
    const CONSOLE_SESSION = "CONSOLE";

    private $web;

    private $api;

    private $console;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->loadRouterFiles();
        $session = $this->getSession();
        switch ($session) {
            case self::WEB_SESSION:
                $this->checkWebRoute();
                break;
            case self::API_SESSION:
                $this->checkApiRoute();
                break;
            case self::CONSOLE_SESSION:
                $this->checkConsoleRoute();
                break;
        }
    }

    private function getSession() {
        if (!empty($_SERVER["SESSIONNAME"]) && $_SERVER["SESSIONNAME"] == self::CONSOLE_SESSION_NAME)
            return self::CONSOLE_SESSION;


        return self::WEB_SESSION;
    }

    private function checkWebRoute()
    {
        print_r($this->web);
    }

    private function checkApiRoute()
    {
        print_r($this->web);
    }

    private function checkConsoleRoute()
    {
        print_r($this->console);
    }

    private function loadRouterFiles()
    {
        $basePath = \Globals::basePath();
        $webPath = "$basePath\\" . self::PATH_WEB_ROUTERS;
        $apiPath = "$basePath\\" . self::PATH_API_ROUTERS;
        $consolePath = "$basePath\\" . self::PATH_CONSOLE_ROUTERS;

        if (!file_exists($webPath) || !file_exists($apiPath) || !file_exists($consolePath))
            throw new \RouterFileNotFoundException();

        $this->web = include $webPath;
        $this->api = include $apiPath;
        $this->console = include $consolePath;
    }

}