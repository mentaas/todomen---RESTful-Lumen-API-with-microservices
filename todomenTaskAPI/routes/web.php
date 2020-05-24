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

$router->get('/tasks/all/{listId}', 'Task\TaskController@index');
$router->post('/tasks', 'Task\TaskController@store');
$router->get('/tasks/{task}', 'Task\TaskController@show');
$router->put('/boards/{task}', 'Task\TaskController@update');
$router->delete('/boards/{task}', 'Task\TaskController@destroy');

$router->get('/boards/assigns/all/{taskId}', 'Task\TaskAssignCommentUserController@index');
$router->post('/boards/assigns', 'Task\TaskAssignCommentController@store');
$router->get('/boards/assigns/{TaskAssign}', 'Task\TaskAssignCommentController@show');
$router->delete('/boards/assigns/{TaskAssign}', 'Task\TaskAssignCommentController@destroy');

$router->get('/boards/comments/all/{taskId}', 'Task\TaskCommentUserController@index');
$router->post('/boards/comments', 'Task\TaskCommentController@store');
$router->get('/boards/comments/{TaskComment}', 'Task\TaskCommentController@show');
$router->put('/boards/comments/{TaskComment}', 'Task\TaskCommentController@update');
$router->delete('/boards/comments/{TaskComment}', 'Task\TaskCommentController@destroy');
