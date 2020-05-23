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

$router->get('/lists/all/{boardId}', 'ListControllers\ListController@index');
$router->post('/lists', 'ListControllers\ListController@store');
$router->get('/lists/{list}', 'ListControllers\ListController@show');
$router->put('/lists/{list}', 'ListControllers\ListController@update');
$router->delete('/lists/{list}', 'ListControllers\ListController@destroy');
