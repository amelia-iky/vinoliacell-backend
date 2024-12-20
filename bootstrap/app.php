<?php

require_once __DIR__.'/../vendor/autoload.php';

// Load Environment
(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

// Set Timezone
date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

// Create The Application
$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

// Facades
$app->withFacades();
$app->withEloquent();

// CORS
$app->middleware([
    Fruitcake\Cors\HandleCors::class,
]);
$app->register(Fruitcake\Cors\CorsServiceProvider::class);
$app->configure('cors');

// Exceptions
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

// Configuration
$app->configure('app');

// Routes
$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});

return $app;
