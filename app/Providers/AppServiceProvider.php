<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Spatie\Ignition\Ignition;

class AppServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot(): void
    {
        // @todo only do this when debug is enabled
        Ignition::make()->register();
    }

    public function register(): void
    {
        $this->getContainer()->add('name', function () {
            return 'Alex';
        });
    }

    public function provides(string $id): bool
    {
        $services = [
            'name'
        ];

        return in_array($id, $services);
    }
}