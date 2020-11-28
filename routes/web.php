<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/** @var \Illuminate\Support\Facades\Route $router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('/', 'UserController@index');
        $router->get('/{id}', 'UserController@show');
        $router->get('create', function () {
            // Matches The "/admin/users" URL
        });
    });
    $router->group(['prefix' => 'accounts'], function () use ($router) {
        $router->get('/', 'UserController@index');
        $router->get('/{id}', 'UserController@show');
        $router->get('create', function () {
            // Matches The "/admin/users" URL
        });
    });
});
