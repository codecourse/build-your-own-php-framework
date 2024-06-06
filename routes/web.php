<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Laminas\Diactoros\Response;
use League\Route\Router;
use Psr\Container\ContainerInterface;

return static function (Router $router, ContainerInterface $container) {
    $router->get('/', HomeController::class);
    $router->get('/dashboard', DashboardController::class);
};