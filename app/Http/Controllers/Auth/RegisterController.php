<?php

namespace App\Http\Controllers\Auth;

use App\Config\Config;
use App\Views\View;
use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class RegisterController
{
    public function __construct(
        protected View $view
    ) {}

    public function index(ServerRequestInterface $request)
    {
        $response = new Response();

        $response->getBody()->write(
            $this->view->render('auth/register.twig')
        );

        return $response;
    }

    public function store(ServerRequestInterface $request)
    {
        dump($request->getParsedBody());
        die();
    }
}