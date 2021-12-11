<?php

namespace Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigLoader
{
    protected string $viewPath;
    protected string $cachePath;

    private FilesystemLoader $loader;
    private Environment $twig;

    public function __construct()
    {
        $this->viewPath = realpath(__DIR__ . "/../resources/views");
        $this->cachePath = realpath(__DIR__ . "/../resources/cache");

        $this->loader = new FilesystemLoader($this->viewPath);
        $this->twig = new Environment(
            $this->loader,
            [
                'debug' => true,
            ]
        );
    }

    public function render(string $templateName, array $variables = []): void
    {
        $this->twig->display($templateName, $variables);
    }
}
