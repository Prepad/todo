<?php

namespace Core\Singleton;

use Exception;

class RequestSingleton
{
    private array $getParameters;
    private array $postParameters;
    private string $rawData;
    private array $headers;
    private string $path;
    private array $customParameters = [];
    private static RequestSingleton $instance;

    public function __set($name, $value)
    {
        $this->customParameters[$name] = $value;
    }

    public function __get($name)
    {
        if (!array_key_exists($name, $this->customParameters)) {
            return null;
        }
        return $this->customParameters[$name];
    }

    private function __construct()
    {
        $this->getParameters = $_GET;
        $this->postParameters = $_POST;
        $this->rawData = file_get_contents('php://input');
        $this->headers = getallheaders();
        $this->path = explode('?',$_SERVER['REQUEST_URI'])[0];
    }

    public static function getInstance(): RequestSingleton
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function get(): array
    {
        return $this->getParameters;
    }

    public function post(): array
    {
        return $this->postParameters;
    }

    public function rawData(): string
    {
        return $this->rawData;
    }

    public function headers(): array
    {
        return $this->headers;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function json(): array
    {
        try {
            return json_decode(
                $this->rawData,
                associative: true,
                flags: JSON_THROW_ON_ERROR
            )['data'];
        } catch(Exception) {
            return [];
        }
    }
}