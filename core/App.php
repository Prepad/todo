<?php

namespace Core;

use Illuminate\Database\Capsule\Manager as Capsule;

class App
{
    private Router $router;
    private TwigLoader $twigLoader;
    private Capsule $capsule;

    public function __construct()
    {
        $this->router = new Router();
        $this->twigLoader = new TwigLoader();
        $this->capsule = new Capsule;

        $this->capsule->addConnection([
            'driver' => 'pgsql',
            'host' => 'db',
            'database' => 'todopet',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }

    public function run(): void
    {
        $this->router->routeStartAction();
    }

    public function routerGetter(): Router
    {
        return $this->router;
    }

    public function twigGetter(): TwigLoader
    {
        return $this->twigLoader;
    }
}
