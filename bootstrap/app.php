<?php

use App\Core\App;
use App\Providers\AppServiceProvider;
use League\Container\Container;
use Spatie\Ignition\Ignition;

error_reporting(0);

require '../vendor/autoload.php';

$container = new Container();
$container->addServiceProvider(new AppServiceProvider());

var_dump($container->get('name'));
die();

$app = new App();

// register routes

$app->run();