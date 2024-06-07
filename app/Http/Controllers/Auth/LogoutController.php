<?php

namespace App\Http\Controllers\Auth;

use App\Config\Config;
use App\Views\View;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class LogoutController
{
    public function __construct(
        protected Sentinel $auth,
        protected Session $session
    ) {}

    public function __invoke(ServerRequestInterface $request)
    {
        $this->auth->logout();

        $this->session->getFlashBag()->add('message', 'You have been logged out.');

        return new Response\RedirectResponse('/');
    }
}