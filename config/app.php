<?php

use App\Providers\AppServiceProvider;
use App\Providers\AuthServiceProvider;
use App\Providers\CsrfServiceProvider;
use App\Providers\DatabaseServiceProvider;
use App\Providers\RequestServiceProvider;
use App\Providers\RouteServiceProvider;
use App\Providers\SessionServiceProvider;
use App\Providers\ViewServiceProvider;

return [
    'name' => env('APP_NAME'),

    'debug' => env('APP_DEBUG'),

    'providers' => [
        AppServiceProvider::class,
        RequestServiceProvider::class,
        RouteServiceProvider::class,
        ViewServiceProvider::class,
        DatabaseServiceProvider::class,
        AuthServiceProvider::class,
        CsrfServiceProvider::class,
        SessionServiceProvider::class,
    ]
];