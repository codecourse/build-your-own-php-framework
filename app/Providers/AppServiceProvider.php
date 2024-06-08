<?php

namespace App\Providers;

use App\Config\Config;
use App\Core\Example;
use Illuminate\Pagination\Paginator;
use Laminas\Diactoros\Request;
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

        Paginator::currentPathResolver(function () {
            return strtok($this->getContainer()->get(Request::class)->getUri(), '?');
        });

        Paginator::queryStringResolver(function () {
            return $this->getContainer()->get(Request::class)->getQueryParams();
        });

        Paginator::currentPageResolver(function ($pageName = 'page') {
            return $this->getContainer()->get(Request::class)->getQueryParams()[$pageName] ?? 1;
        });
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