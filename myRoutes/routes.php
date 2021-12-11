<?php

use App\Controller\HomeController;
use App\Controller\TodoController;
use Core\Router;

/** @var Router $router */
$router = $app->routerGetter();

$router->get('/', [TodoController::class, 'allTodos']);
$router->post('/', [TodoController::class, 'addTodo']);
$router->post('/edit', [TodoController::class, 'update']);
