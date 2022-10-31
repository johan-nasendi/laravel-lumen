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

// Basic Routing
// $router->get('foo', function () {
//     return 'Hello World';
// });

// Required Parameters
// $router->get('user/{id}', function ($id) {
//     return 'User '.$id;
// });

// Optional Parameters
// $router->get('optional[/{params}]', function ($params = null) {
//     return $params;
// });

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



$router->post('/register','AuthController@register');
$router->post('/login','AuthController@login');

