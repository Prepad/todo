<?php

use App\Controller\HomeController;
use App\Controller\TodoController;
use Core\Router;

/** @var Router $router */
$router = $app->routerGetter();
$router->get('/test', function() {
    echo 'test route';
});
$router->get('/', [HomeController::class, 'indexPage']);

$router->get('/todo', [TodoController::class, 'allTodos']);
$router->get('/todo/add', [TodoController::class, 'addTodo']);
