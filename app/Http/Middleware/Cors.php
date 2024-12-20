<?php

use Fruitcake\Cors\HandleCors;

class Middleware
{
    protected $routeMiddleware = [
        'cors' => HandleCors::class,
    ];
}
