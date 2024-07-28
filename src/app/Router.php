<?php

namespace App;

use App\Exception\RouteNotFoundException;

class Router
{
    private array $routes = [];

    public function __construct(private Container $container = new Container())
    {
    }
    public function addRoute(string $requestMethod, string $route, callable|array $action): self
    {
        $this->routes[$requestMethod][$route] = $action;
        return $this;
    }

    public function get(string $route, callable|array $action): self
    {
        return $this->addRoute("GET", $route, $action);
    }

    public function post(string $route, callable|array $action): self
    {
        return $this->addRoute("POST", $route, $action);
    }

    public function put(string $route, callable|array $action): self
    {
        return $this->addRoute("PUT", $route, $action);
    }

    public function delete(string $route, callable|array $action): self
    {
        return $this->addRoute("DELETE", $route, $action);
    }
    public function options(string $route, callable|array $action): self
    {
        return $this->addRoute("OPTIONS", $route, $action);
    }

    public function routes(): array
    {
        return $this->routes;
    }

    public function resolve(string $requestUrl, string $requestMethod)
    {
        $route = explode('?', $requestUrl)[0];
        $action = $this->routes[$requestMethod][$route] ?? null;

        if(!$action){
            throw new RouteNotFoundException();
        }

        if(is_callable($action)){
            return call_user_func($action);
        }

        if(is_array($action)){
            [$class, $method] = $action;

            if(class_exists($class)){
                $class = $this->container->get($class);

                if(method_exists($class, $method)){
                    return call_user_func_array([$class, $method],[]);
                }
            }
        }

        throw new RouteNotFoundException();
    }
}
