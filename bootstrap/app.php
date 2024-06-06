<?php

use App\Config\Config;
use App\Core\App;
use App\Core\Container;
use App\Core\Example;
use App\Core\View;
use App\Providers\AppServiceProvider;
use App\Providers\ConfigServiceProvider;
use League\Container\ReflectionContainer;
use Spatie\Ignition\Ignition;

error_reporting(0);

require '../vendor/autoload.php';

$container = Container::getInstance();
$container->delegate(new ReflectionContainer());
$container->addServiceProvider(new ConfigServiceProvider());

$config = $container->get(Config::class);

foreach ($config->get('app.providers') as $provider) {
    $container->addServiceProvider(new $provider);
}

$app = new App();

// register routes

$app->run();