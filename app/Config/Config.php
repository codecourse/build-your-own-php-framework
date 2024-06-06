<?php

namespace App\Config;

class Config
{
    protected array $config = [
        'app' => [
            'name' => 'No framework'
        ]
    ];

    public function get(string $key, $default = null)
    {
        return dot($this->config)->get($key) ?? $default;
    }
}