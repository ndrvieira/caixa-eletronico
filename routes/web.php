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
    return \Illuminate\Support\Facades\DB::select('SELECT * FROM lumen.users');
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('/', 'UserController@index');
        $router->get('/{id}', 'UserController@show');
        $router->post('/', 'UserController@create');
        $router->put('/{id}', 'UserController@edit');
        $router->delete('/{id}', 'UserController@delete');
    });
    $router->group(['prefix' => 'accounts'], function () use ($router) {
        $router->get('/', 'UserController@index');
        $router->post('create', 'UserController@create');
        $router->get('/{id}', 'UserController@show');
    });
});
