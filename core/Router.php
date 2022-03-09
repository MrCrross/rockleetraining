<?php

namespace Core;

class Router
{
    protected $routes = [];
    protected $params = [];

    public function __construct()
    {
        $arr = require_once 'config/routes.php';
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
    }

    public function add($route, $params)
    {
        $params['name']=$route;
        $route = '#^' . $route . '$#';
        $this->routes[$route] = $params;
    }

    public function run()
    {
        if ($this->match()) {
            $controller_path = 'Controllers\\' . $this->params['controller'];
            $method = $this->params['action'];
            if (method_exists($controller_path,$method)) {
                $controller = new $controller_path($this->params);
                $controller->$method();
            } else {
                View::errors(404);
            }
        }else{
            View::errors(404);
        }
    }

    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                if(preg_match("/\d+/", $url, $id)){
                    $_GET['id']=$id[0];
                }
                return true;
            }
        }
        return false;
    }

}