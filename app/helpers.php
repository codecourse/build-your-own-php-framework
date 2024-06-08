<?php

use App\Core\Container;

function app(string $abstract)
{
    return Container::getInstance()->get($abstract);
}