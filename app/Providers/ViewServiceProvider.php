<?php

namespace App\Providers;

use App\Config\Config;
use App\Core\Example;
use App\Views\TwigExtension;
use App\Views\TwigRuntimeLoader;
use App\Views\View;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Spatie\Ignition\Ignition;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class ViewServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        $this->getContainer()->add(View::class, function () {
            $loader = new FilesystemLoader(__DIR__ . '/../../resources/views');

            $twig = new Environment($loader, [
                'cache' => false,
                'debug' => config('app.debug')
            ]);

            $twig->addRuntimeLoader(new TwigRuntimeLoader($this->getContainer()));
            $twig->addExtension(new TwigExtension());
            $twig->addExtension(new DebugExtension());

            return new View($twig);
        });
    }

    public function provides(string $id): bool
    {
        $services = [
            View::class
        ];

        return in_array($id, $services);
    }
}