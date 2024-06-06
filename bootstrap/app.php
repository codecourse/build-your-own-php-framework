<?php

use App\Core\App;
use League\Container\Container;
use Spatie\Ignition\Ignition;

error_reporting(0);

require '../vendor/autoload.php';

Ignition::make()->register();

$container = new Container();
$container->add('name', function () {
    return 'Alex';
});

var_dump($container->get('name'));
die();

$app = new App();

// register routes

$app->run();