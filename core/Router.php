<?php
namespace Core;

class Router
{
    private array $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    public function get(string $route, callable|array $callback): void
    {
        $this->routes[$route] = $callback;
    }

    public function routeGetter(string $route): void
    {
        if(array_key_exists($route, $this->routes)) {
            forward_static_call($this->routes[$route]);
            return;
        } 
        echo '404 not found';
    }

    public function routeStartAction(): void
    {
        $this->routeGetter(explode('?',$_SERVER['REQUEST_URI'])[0]); 
    }
}
