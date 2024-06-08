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
            new TwigFunction('auth', [TwigRuntimeExtension::class, 'auth']),
            new TwigFunction('csrf', [TwigRuntimeExtension::class, 'csrf']),
            new TwigFunction('session', [TwigRuntimeExtension::class, 'session']),
            new TwigFunction('old', [TwigRuntimeExtension::class, 'old']),
            new TwigFunction('route', [TwigRuntimeExtension::class, 'route']),
        ];
    }
}