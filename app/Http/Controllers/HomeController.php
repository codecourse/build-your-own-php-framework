<?php

namespace App\Http\Controllers;

use App\Config\Config;
use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class HomeController
{
    public function __construct(
        protected Config $config
    ) {}

    public function __invoke(ServerRequestInterface $request)
    {
        $response = new Response();

        $response->getBody()->write($this->config->get('app.name'));

        return $response;
    }
}