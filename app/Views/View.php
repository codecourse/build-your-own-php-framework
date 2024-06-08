<?php

namespace App\Views;

use Twig\Environment;

class View
{
    public function __construct(protected Environment $twig) {}

    public function exists(string $view)
    {
        return $this->twig->getLoader()->exists($view);
    }

    public function render(string $view, array $data = [])
    {
        return $this->twig->render($view, $data);
    }
}