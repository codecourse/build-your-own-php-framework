<?php

use App\Providers\AppServiceProvider;

return [
    'name' => env('APP_NAME'),

    'debug' => env('APP_DEBUG'),

    'providers' => [
        AppServiceProvider::class,
    ]
];