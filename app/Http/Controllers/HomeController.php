<?php

namespace App\Http\Controllers;

use App\Config\Config;
use App\Models\User;
use App\Views\View;
use Illuminate\Database\DatabaseManager;
use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class HomeController
{
    public function __construct(
        protected Config $config,
        protected View $view
    ) {}

    public function __invoke(ServerRequestInterface $request)
    {
        return view('home.twig', [
            'name' => $this->config->get('app.name'),
            'users' => User::paginate(1),
        ]);
    }
}