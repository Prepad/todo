<?php
namespace Core;

use Carbon\Exceptions\UnknownMethodException;
use Exception;

/**
 * @method get(string $route, callable|array $callback): void
 * @method post(string $route, callable|array $callback): void
 * @method delete(string $route, callable|array $callback): void
 */
class Router
{
    private array $routes;

    public function __construct()
    {
        $this->routes = ['get' => [], 'post' => [], 'delete' => []];
    }

    public function __call($name, $arguments)
    {
        if (!in_array($name, ['get', 'post', 'delete'])) {
            throw new UnknownMethodException($name);
        }

        $this->registerRoute($name, ...$arguments);
    }

    private function registerRoute(string $method, string $route, callable|array $callback): void
    {
        $this->routes[$method][$route] = $callback;
    }

    public function routeGetter(string $route, string $method): void
    {
        if(array_key_exists($route, $this->routes[$method])) {
            forward_static_call($this->routes[$method][$route]);
            return;
        } 
        echo '404 not found';
    }

    public function routeStartAction(): void
    {
        $this->routeGetter(
            explode('?',$_SERVER['REQUEST_URI'])[0],
            mb_strtolower($_SERVER['REQUEST_METHOD'])
        ); 
    }
}
