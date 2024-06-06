<?php

namespace App\Views;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('config', [TwigRuntimeExtension::class, 'config']),
        ];
    }
}