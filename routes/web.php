<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ExampleMiddleware;
use App\Http\Middleware\FlashOldDataMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfGuest;
use Laminas\Diactoros\Response;
use League\Route\RouteGroup;
use League\Route\Router;
use Psr\Container\ContainerInterface;

return static function (Router $router, ContainerInterface $container) {
    $router->middleware($container->get('csrf'));
    $router->middleware(new FlashOldDataMiddleware());

    $router->get('/', HomeController::class)
        ->setName('home');

    $router->group('/', function (RouteGroup $route) {
        $route->get('/register', [RegisterController::class, 'index']);
        $route->post('/register', [RegisterController::class, 'store']);
        $route->get('/login', [LoginController::class, 'index']);
        $route->post('/login', [LoginController::class, 'store']);
    })
        ->middleware(new RedirectIfAuthenticated());

    $router->group('/', function (RouteGroup $route) {
        $route->get('/dashboard', DashboardController::class);
        $route->post('/logout', LogoutController::class);
    })
        ->middleware(new RedirectIfGuest());

    $router->get('/users/{user}', UserController::class)
        ->setName('users.show');
};