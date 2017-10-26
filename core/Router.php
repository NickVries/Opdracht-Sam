<?php

namespace Nick\Framework;

class Router
{
    public $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;

    }

    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
//            return $this->routes[$requestType][$uri];
            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
        //PagesController@home
            );
        } else {
            return $this->direct('404', 'GET');
        }
//        {
//            throw new Exception('No route defined for this URI.');
//        }
    }

    protected function callAction($controller, $action)
    {
        $controllerInstance = new $controller;
        if (! method_exists($controllerInstance, $action)) {
            throw new \Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }
        return $controllerInstance->$action();
    }
}
