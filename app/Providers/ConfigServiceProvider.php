<?php

namespace App\Providers;

use App\Config\Config;
use App\Core\Example;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Spatie\Ignition\Ignition;

class ConfigServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        $this->getContainer()->add(Config::class, function () {
           $config = new Config();

           return $this->mergeConfigFromFiles($config);
        })
            ->setShared();
    }

    protected function mergeConfigFromFiles(Config $config)
    {
        $path = __DIR__ . '/../../config';

        foreach (array_diff(scandir($path), ['.', '..']) as $file) {
            $config->merge([
                explode('.', $file)[0] => require($path . '/' . $file)
            ]);
        }

        return $config;
    }

    public function provides(string $id): bool
    {
        $services = [
            Config::class,
        ];

        return in_array($id, $services);
    }
}