<?php

namespace App\Http\Controllers;

use App\Config\Config;
use App\Models\User;
use App\Views\View;
use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class UserController
{
    public function __construct(
        protected View $view
    ) {}

    public function __invoke(ServerRequestInterface $request, array $arguments)
    {
        ['user' => $userId] = $arguments;

        $user = User::findOrFail($userId);

        $response = new Response();

        $response->getBody()->write(
            $this->view->render('user.twig', [
                'user' => $user
            ])
        );

        return $response;
    }
}