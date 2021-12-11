<?php

namespace App\Controller;

class HomeController
{
    public static function indexPage()
    {
        renderView('index.html.twig', ['answer_time' => $_SERVER['REQUEST_TIME']]);
    }
}
