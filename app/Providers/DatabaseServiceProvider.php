<?php

namespace App\Providers;

use App\Config\Config;
use App\Core\Example;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\DatabaseManager;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Spatie\Ignition\Ignition;

class DatabaseServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    protected Manager $capsule;

    public function boot(): void
    {
        $config = $this->getContainer()->get(Config::class);

        $capsule = new Manager();
        $driver = $config->get('database.driver');

        $capsule->addConnection(
            $config->get('database.' . $driver),
            $driver
        );

        $capsule->bootEloquent();

        $capsule->getDatabaseManager()->setDefaultConnection($driver);

        $this->capsule = $capsule;
    }

    public function register(): void
    {
        $this->getContainer()->add(DatabaseManager::class, function () {
            return $this->capsule->getDatabaseManager();
        })
            ->setShared();
    }

    public function provides(string $id): bool
    {
        $services = [
            DatabaseManager::class
        ];

        return in_array($id, $services);
    }
}