<?php

use App\Config\Config;
use App\Core\App;
use App\Core\Container;
use App\Core\Example;
use App\Core\View;
use App\Providers\AppServiceProvider;
use App\Providers\ConfigServiceProvider;
use Dotenv\Dotenv;
use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Container\ReflectionContainer;
use League\Route\Router;
use Spatie\Ignition\Ignition;

error_reporting(0);

require '../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$container = Container::getInstance();
$container->delegate(new ReflectionContainer());
$container->addServiceProvider(new ConfigServiceProvider());

$config = $container->get(Config::class);

foreach ($config->get('app.providers') as $provider) {
    $container->addServiceProvider(new $provider);
}

$app = new App($container);

(require('../routes/web.php'))($app->getRouter(), $container);

$app->run();