<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => '/api'], function () use ($router) {
    // Authentication
    $router->post('signup', 'AuthController@signup');
    $router->post('signin', 'AuthController@signin');

    // Brands
    $router->get('brands', 'BrandController@getAll');

    // Issues
    $router->get('issues', 'IssueController@getAll');

    // Protected routes for both 'users and admin'
    $router->group(['middleware' => 'auth'], function () use ($router) {
        // Orders
        $router->get('orders', 'OrderController@getAll');
        $router->get('orders/{id}', 'OrderController@getByID');
    });

    // Protected routes for users
    $router->group(['middleware' => 'auth:user'], function () use ($router) {
        // Orders
        $router->post('orders', 'OrderController@create');
    });

    // Protected routes for admin
    $router->group(['middleware' => 'auth:admin'], function () use ($router) {
        // Orders
        $router->put('orders/{id}', 'OrderController@update');

        // Users Data
        $router->get('users', 'AdminController@getDataUser');
    });
});
