<?php

namespace App\Providers;

use App\Config\Config;
use App\Core\Example;
use App\Views\View;
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
            return strtok(app(Request::class)->getUri(), '?');
        });

        Paginator::queryStringResolver(function () {
            return app(Request::class)->getQueryParams();
        });

        Paginator::currentPageResolver(function ($pageName = 'page') {
            return app(Request::class)->getQueryParams()[$pageName] ?? 1;
        });

        Paginator::viewFactoryResolver(function () {
            return app(View::class);
        });

        Paginator::defaultView('pagination/default.twig');
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