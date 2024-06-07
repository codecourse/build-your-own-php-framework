<?php

namespace App\Views;

use App\Config\Config;
use Cartalyst\Sentinel\Sentinel;
use Psr\Container\ContainerInterface;
use Twig\Extension\AbstractExtension;

class TwigRuntimeExtension extends AbstractExtension
{
    public function __construct(protected ContainerInterface $container) {}

    public function config()
    {
        return $this->container->get(Config::class);
    }

    public function auth()
    {
        return $this->container->get(Sentinel::class);
    }

    public function csrf()
    {
        $guard = $this->container->get('csrf');

        return '
            <input type="hidden" name="' . $guard->getTokenNameKey() . '" value="' . $guard->getTokenName() . '">
            <input type="hidden" name="' . $guard->getTokenValueKey() .'" value="' . $guard->getTokenValue() . '">
        ';
    }
}