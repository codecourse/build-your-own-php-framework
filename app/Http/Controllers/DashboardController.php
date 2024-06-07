<?php

namespace App\Http\Controllers;

use App\Config\Config;
use App\Views\View;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class DashboardController
{
    public function __construct(
        protected View $view,
        protected Sentinel $auth
    ) {}

    public function __invoke(ServerRequestInterface $request)
    {
        $response = new Response();

        $response->getBody()->write(
            $this->view->render('dashboard.twig')
        );

        return $response;
    }
}