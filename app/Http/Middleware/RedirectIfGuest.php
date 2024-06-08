<?php

namespace App\Http\Middleware;

use App\Core\Container;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class RedirectIfGuest implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $container = Container::getInstance();

        if (!$container->get(Sentinel::class)->check()) {
            $container->get(Session::class)->getFlashBag()->add('message', 'Log in before doing that.');
            return new RedirectResponse('/login');
        }

        return $handler->handle($request);
    }
}