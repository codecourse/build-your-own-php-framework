<?php

namespace App\Exceptions;

use App\Views\View;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ExceptionHandler
{
    public function __construct(protected View $view) {}

    public function handle(ServerRequestInterface $request, ResponseInterface $response, \Throwable $e)
    {
        if ($view = $this->getErrorView($e)) {
            $response->getBody()->write($view);
            return $response;
        }

        throw $e;
    }

    protected function getErrorView(\Throwable $e)
    {
        if (!method_exists($e, 'getStatusCode')) {
            return null;
        }

        $view = 'errors/' . $e->getStatusCode() . '.twig';

        if (!$this->view->exists($view)) {
            return null;
        }

        return $this->view->render($view);
    }
}