<?php

use Core\App;

function renderView(string $templateName, array $variables = [])
{
    /** @var Core\App $app */
    $app =  $GLOBALS['app'];
    $twigLoader = $app->twigGetter();
    $twigLoader->render($templateName, $variables);
};
