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
});
