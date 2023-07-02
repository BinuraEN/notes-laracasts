<?php

namespace Core;
use Core\Middleware\Middleware;
use Core\Response;
class Router
{
    protected $routes = [];

    public function add($method,$uri,$controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }
    public function get($uri, $controller)
    {
        return $this->add('GET',$uri,$controller);
    }

    public function post($uri, $controller)
    {
        return $this->add('POST',$uri,$controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add('DELETE',$uri,$controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add('PATCH',$uri,$controller);
    }

    public function put($uri, $controller)
    {
        return $this->add('PUT',$uri,$controller);
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] =$key;

        return $this;
    }

    public function route($uri,$method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                //apply middleware
                try {
                    Middleware::resolve($route['middleware']);
                } catch (\Exception $e) {
                    echo $e->getMessage();
                    die();
                }

                return require base_path('Http/controllers/'.$route['controller']);
            }
        }
        $this->abort();
    }

    public function previousUrl(){
        return $_SERVER['HTTP_REFERER'];
    }

    protected function abort($code = Response::NOT_FOUND)
    {
        http_response_code($code);
        require base_path("views/{$code}.php");
        die();
    }



}

//use Core\Response;
//
//
//$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
//
//$routes = require base_path("routes.php");
//
//function abort($code = Response::NOT_FOUND)
//{
//    http_response_code($code);
//    require base_path("views/{$code}.php");
//    die();
//}
//
//function routeToController($uri, $routes)
//{
//    if (array_key_exists($uri, $routes)) {
//        require base_path($routes[$uri]);
//    } else {
//        abort();
//    }
//}

//routeToController($uri, $routes);
