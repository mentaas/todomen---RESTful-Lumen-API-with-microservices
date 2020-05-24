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
$router->put('/tasks/{task}', 'Task\TaskController@update');
$router->delete('/tasks/{task}', 'Task\TaskController@destroy');

$router->get('/tasks/assigns/all/{taskId}', 'Task\TaskAssignCommentUserController@index');
$router->post('/tasks/assigns', 'Task\TaskAssignCommentController@store');
$router->get('/tasks/assigns/{TaskAssign}', 'Task\TaskAssignCommentController@show');
$router->delete('/tasks/assigns/{TaskAssign}', 'Task\TaskAssignCommentController@destroy');

$router->get('/tasks/comments/all/{taskId}', 'Task\TaskCommentUserController@index');
$router->post('/tasks/comments', 'Task\TaskCommentController@store');
$router->get('/tasks/comments/{TaskComment}', 'Task\TaskCommentController@show');
$router->put('/tasks/comments/{TaskComment}', 'Task\TaskCommentController@update');
$router->delete('/tasks/comments/{TaskComment}', 'Task\TaskCommentController@destroy');
