<?php

use App\Core\App;
use App\Core\Container;
use App\Core\Example;
use App\Core\View;
use App\Providers\AppServiceProvider;
use League\Container\ReflectionContainer;
use Spatie\Ignition\Ignition;

error_reporting(0);

require '../vendor/autoload.php';

$container = Container::getInstance();
$container->delegate(new ReflectionContainer());
$container->addServiceProvider(new AppServiceProvider());

$app = new App();

// register routes

$app->run();