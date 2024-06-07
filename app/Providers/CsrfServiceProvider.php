<?php

namespace App\Providers;

use App\Config\Config;
use App\Core\Example;
use Laminas\Diactoros\ResponseFactory;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Slim\Csrf\Guard;
use Spatie\Ignition\Ignition;

class CsrfServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        $this->getContainer()->add('csrf', function () {
            $guard = new Guard(new ResponseFactory());

            return $guard;
        })
            ->setShared();
    }

    public function provides(string $id): bool
    {
        $services = [
            'csrf'
        ];

        return in_array($id, $services);
    }
}