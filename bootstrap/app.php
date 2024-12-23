<?php

require_once __DIR__ . '/../vendor/autoload.php';

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

// Register Service Providers
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(Tymon\JWTAuth\Providers\LumenServiceProvider::class);
$app->register(Fruitcake\Cors\CorsServiceProvider::class);

// Middleware
$app->middleware([
    Fruitcake\Cors\HandleCors::class,
]);
$app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class,
]);

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
$app->configure('cors');
$app->configure('jwt');

// Routes
$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__ . '/../routes/web.php';
});

return $app;
