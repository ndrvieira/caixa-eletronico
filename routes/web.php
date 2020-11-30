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

    /** Endpoints /users */
    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('/', 'UserController@index');
        $router->post('/', 'UserController@create');

        /** Endpoints /users/{user_id} */
        $router->group(['prefix' => '{user_id}'], function () use ($router) {
            $router->get('/', 'UserController@show');
            $router->put('/', 'UserController@edit');
            $router->delete('/', 'UserController@delete');

            /** Endpoints /users/{user_id}/accounts */
            $router->group(['prefix' => 'accounts'], function () use ($router) {
                $router->get('/', 'AccountController@index');
                $router->post('/', 'AccountController@create');

                /** Endpoints /users/{user_id}/accounts/{account_id} */
                $router->group(['prefix' => '{account_id}'], function () use ($router) {
                    $router->get('/', 'AccountController@index');
                    $router->post('/deposit', 'AccountController@deposit');
                    $router->post('/withdraw', 'AccountController@withdraw');
                    $router->get('/statement', 'AccountController@statement');
                });

            });

        });

    });

});
