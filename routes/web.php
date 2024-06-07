<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use Laminas\Diactoros\Response;
use League\Route\Router;
use Psr\Container\ContainerInterface;

return static function (Router $router, ContainerInterface $container) {
    $router->get('/', HomeController::class);
    $router->get('/dashboard', DashboardController::class);

    $router->get('/register', [RegisterController::class, 'index']);
    $router->post('/register', [RegisterController::class, 'store']);

    $router->get('/login', [LoginController::class, 'index']);
    $router->post('/login', [LoginController::class, 'store']);

    $router->post('/logout', LogoutController::class);

    $router->get('/users/{user}', UserController::class);
};