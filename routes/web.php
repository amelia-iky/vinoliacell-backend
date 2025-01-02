<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    // Authentication
    $router->post('signup', 'AuthController@signup');
    $router->post('signin', 'AuthController@signin');

    // Brands
    $router->get('brands', 'BrandController@getAll');

    // Issues
    $router->get('issues', 'IssueController@getAll');

    // Protected routes
    $router->group(['middleware' => 'auth:api'], function () use ($router) {
        $router->post('orders', 'OrderController@create');
        $router->get('orders', 'OrderController@getAll');
    });
});
