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

// generete Application Key
// $router->get('/key', function () {
//     return  \Illuminate\Support\Str::random(32);
// });

$router->get(config('swagger-lume.routes.docs'), [
    'as' => 'swagger-lume.docs',
    'middleware' => config('swagger-lume.routes.middleware.docs', []),
    'uses' => 'Http\Controllers\SwaggerLumeController@docs',
]);

$router->get(config('swagger-lume.routes.api'), [
    'as' => 'swagger-lume.api',
    'middleware' => config('swagger-lume.routes.middleware.api', []),
    'uses' => 'Http\Controllers\SwaggerLumeController@api',
]);

$router->get(config('swagger-lume.routes.assets').'/{asset}', [
    'as' => 'swagger-lume.asset',
    'middleware' => config('swagger-lume.routes.middleware.asset', []),
    'uses' => 'Http\Controllers\SwaggerLumeAssetController@index',
]);

$router->get(config('swagger-lume.routes.oauth2_callback'), [
    'as' => 'swagger-lume.oauth2_callback',
    'middleware' => config('swagger-lume.routes.middleware.oauth2_callback', []),
    'uses' => 'Http\Controllers\SwaggerLumeController@oauth2Callback',
]);

// Group
$router->group(['prefix' => 'api/admin', 'middleware' => 'auth'], function ()  use ($router) {

    $router->get('/users/all', 'ExampleController@index');

});

// Group
$router->group(['prefix' => 'api/', 'middleware' => 'auth'], function ()  use ($router) {

    $router->get('todo/all', 'TodoController@index');
    $router->post('todo/create', 'TodoController@store');
    $router->get('todo/show/{id}', 'TodoController@show');
    $router->get('todo/edit/{id}', 'TodoController@edit');
    $router->put('todo/update/{id}', 'TodoController@update');
    $router->delete('todo/{id}', 'TodoController@destroy');

});



$router->post('/api/register','AuthController@register');
$router->post('/api/login','AuthController@login');



