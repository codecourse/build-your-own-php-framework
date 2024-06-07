<?php

namespace App\Providers;

use App\Config\Config;
use App\Core\Example;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Respect\Validation\Factory;
use Spatie\Ignition\Ignition;

class AppServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot(): void
    {
        if ($this->getContainer()->get(Config::class)->get('app.debug')) {
            Ignition::make()->register();
        }

        Factory::setDefaultInstance(
            (new Factory())
                ->withRuleNamespace('App\\Validation\\Rules')
                ->withExceptionNamespace('App\\Validation\\Exceptions')
        );
    }

    public function register(): void
    {
        //
    }

    public function provides(string $id): bool
    {
        $services = [
            //
        ];

        return in_array($id, $services);
    }
}