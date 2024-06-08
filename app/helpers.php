<?php

use App\Config\Config;
use App\Core\Container;
use App\Models\User;
use App\Views\View;
use Laminas\Diactoros\Response;
use League\Route\Route;
use League\Route\Router;

function app(string $abstract)
{
    return Container::getInstance()->get($abstract);
}

function view(string $view, array $data = [])
{
    $response = new Response();

    $response->getBody()->write(
        app(View::class)->render($view, $data)
    );

    return $response;
}

function config(string $key, $default = null)
{
    return app(Config::class)->get($key, $default);
}

function route(string $name, array $arguments = [])
{
    return app(Router::class)->getNamedRoute($name)->getPath($arguments);
}