<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('signup', 'AuthController@signup');
$router->post('signin', 'AuthController@signin');

$router->group(['middleware' => 'auth:api'], function () use ($router) {});
