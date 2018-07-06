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

    private $server;

    private $controller;

    private $method;

    private $queryParams;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->loadRouterFiles();
        $this->server = $_SERVER;
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

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    private function getSession() {
        if (!empty($_SERVER["SESSIONNAME"]) && $_SERVER["SESSIONNAME"] == self::CONSOLE_SESSION_NAME)
            return self::CONSOLE_SESSION;

        // @TODO check API session

        return self::WEB_SESSION;
    }

    public function getRequestMethod()
    {
        return $this->server["REQUEST_METHOD"];
    }

    private function getRequestUri()
    {
        $uri = $this->server["REQUEST_URI"];
        $exUri = explode("?", $uri);

        if (count($exUri) == 1)
            return $uri;

        parse_str($exUri[1], $this->queryParams);

        return $exUri[0];
    }

    private function checkWebRoute()
    {
        $requestUri = $this->getRequestUri();

        if (!array_key_exists($requestUri, $this->web))
            throw new \RouteNotFoundException();

        if (!in_array($this->getRequestMethod(), $this->web[$requestUri]["method"]))
            throw new \InvalidRouteMethodException();

        $action = explode("@", $this->web[$requestUri]["action"]);
        $this->controller = $action[0];
        $this->method = $action[1] . "Action";
    }

    private function checkApiRoute()
    {
        $requestUri = $this->getRequestUri();

        if (!array_key_exists($requestUri, $this->web))
            throw new \RouteNotFoundException();

        if (!in_array($this->getRequestMethod(), $this->web[$requestUri]["method"]))
            throw new \InvalidRouteMethodException();
    }

    private function checkConsoleRoute()
    {
        // @TODO console routes

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