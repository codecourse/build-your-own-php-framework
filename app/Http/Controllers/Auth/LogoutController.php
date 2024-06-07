<?php

namespace App\Http\Controllers\Auth;

use App\Config\Config;
use App\Views\View;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class LogoutController
{
    public function __construct(
        protected Sentinel $auth
    ) {}

    public function __invoke(ServerRequestInterface $request)
    {
        $this->auth->logout();

        return new Response\RedirectResponse('/');
    }
}