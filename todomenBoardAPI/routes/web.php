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

$router->get('/boards/all/{workspaceId}', 'Board\BoardController@index');
$router->post('/boards', 'Board\BoardController@store');
$router->get('/boards/{board}', 'Board\BoardController@show');
$router->put('/boards/{board}', 'Board\BoardController@update');
$router->delete('/boards/{board}', 'Board\BoardController@destroy');

$router->get('/boards/users/all/{boardId}', 'Board\BoardUserController@index');
$router->post('/boards/users', 'Board\BoardUserController@store');
$router->get('/boards/users/{boardUser}', 'Board\BoardUserController@show');
$router->put('/boards/users/{boardUser}', 'Board\BoardUserController@update');
$router->delete('/boards/users/{boardUser}', 'Board\BoardUserController@destroy');
