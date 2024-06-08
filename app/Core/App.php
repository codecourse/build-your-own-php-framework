<?php

namespace App\Core;

use App\Exceptions\ExceptionHandler;
use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

class App
{
    protected ServerRequestInterface $request;

    protected Router $router;

    public function __construct(protected ContainerInterface $container)
    {
        $this->request = $this->container->get(Request::class);
        $this->router = $this->container->get(Router::class);
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function run()
    {
        $response = new Response();

        try {
            $response = $this->router->dispatch($this->request);
        } catch (\Throwable $e) {
            $response = $this->container->get(ExceptionHandler::class)
                ->handle($this->request, $response, $e);
        }

        (new SapiEmitter())->emit(
            $response
        );
    }
}