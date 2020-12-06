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
    return view('scribe/index');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'v1'], function () use ($router) {

        /** Endpoints /users */
        $router->group(['prefix' => 'users'], function () use ($router) {
            $router->get('/', 'UserController@index');
            $router->post('/', 'UserController@create');

            /** Endpoints /users/{user_id} */
            $router->group(['prefix' => '{user_id}'], function () use ($router) {
                $router->get('/', 'UserController@show');
                $router->patch('/', 'UserController@edit');
                $router->delete('/', 'UserController@delete');

                /** Endpoints /users/{user_id}/accounts */
                $router->group(['prefix' => 'accounts'], function () use ($router) {
                    $router->get('/', 'AccountController@index');
                    $router->post('/', 'AccountController@create');

                    /** Endpoints /users/{user_id}/accounts/{account_id} */
                    $router->group(['prefix' => '{account_id}'], function () use ($router) {
                        $router->post('/deposit', 'AccountController@deposit');
                        $router->post('/withdraw', 'AccountController@withdraw');
                        $router->get('/statement', 'AccountController@statement');
                    });

                });

            });

        });

    });
});
