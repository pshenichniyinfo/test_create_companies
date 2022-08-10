<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router){
    $router->group(['prefix' => 'user', 'namespace' => 'User'], function () use ($router){
        $router->post('register', 'AuthController@register');
        $router->post('sign-in', 'AuthController@sign_in');
        $router->post('/password/reset-request', 'RequestPasswordController@sendResetLinkEmail');
        $router->post('/password/reset', [ 'as' => 'password.reset', 'uses' => 'ResetPasswordController@reset' ]);

        $router->group(['namespace' => 'Company', 'middleware' => 'apiToken'], function () use ($router){
            $router->get('companies', 'CompanyController@companies');
            $router->post('companies', 'CompanyController@add_company');
        });
    });
});
