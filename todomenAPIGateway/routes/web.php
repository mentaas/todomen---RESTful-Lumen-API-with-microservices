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

//$router->get('/', function () use ($router) {
//    return $router->app->version();
//});
$router->group(['middleware' => 'auth'], function() use ($router) {

    //workspaces
    $router->get('/workspaces', 'Workspace\WorkspaceController@index');
    $router->post('/workspaces', 'Workspace\WorkspaceController@store');
    $router->get('/workspaces/{workspace}', 'Workspace\WorkspaceController@show');
    $router->put('/workspaces/{workspace}', 'Workspace\WorkspaceController@update');
    $router->delete('/workspaces/{workspace}', 'Workspace\WorkspaceController@destroy');

    //workspaceAdmins
    $router->get('/workspaces/admins/{workspaceId}', 'Workspace\WorkspaceController@indexAdmin');
    $router->post('/workspaces/admins', 'Workspace\WorkspaceController@storeAdmin');
    $router->get('/workspaces/admins/{workspaceId}/{adminId}', 'Workspace\WorkspaceController@showAdmin');
    $router->put('/workspaces/admins/{workspaceAdmin}', 'Workspace\WorkspaceController@updateAdmin');
    $router->delete('/workspaces/admins/{workspaceAdmin}', 'Workspace\WorkspaceController@destroyAdmin');

    //workspaceUser
    $router->get('/workspaces/users/{workspaceId}', 'Workspace\WorkspaceController@indexUser');
    $router->post('/workspaces/users', 'Workspace\WorkspaceController@storeUser');
    $router->get('/workspaces/users/{workspaceId}/{adminId}', 'Workspace\WorkspaceController@showUser');
    $router->put('/workspaces/users/{workspaceUser}', 'Workspace\WorkspaceController@updateUser');
    $router->delete('/workspaces/user/{workspaceUser}', 'Workspace\WorkspaceController@destroyUser');

    //workspaceInvitation
    $router->get('/workspaces/invitations/{statusId}/{workspaceId}', 'Workspace\WorkspaceController@indexInvitation');
    $router->post('/workspaces/invitations', 'Workspace\WorkspaceController@storeInvitation');
    $router->delete('/workspaces/invitations/{workspaceInvitation}', 'Workspace\WorkspaceController@destroyAdmin');

    //board
    $router->get('/boards/all/{workspaceId}', 'Board\BoardController@index');
    $router->post('/boards', 'Board\BoardController@store');
    $router->get('/boards/{board}', 'Board\BoardController@show');
    $router->put('/boards/{board}', 'Board\BoardController@update');
    $router->delete('/boards/{board}', 'Board\BoardController@destroy');

    //boardUser
    $router->get('/boards/users/all/{boardId}', 'Board\BoardController@indexUser');
    $router->post('/boards/users', 'Board\BoardController@storeUser');
    $router->get('/boards/users/{boardUser}', 'Board\BoardController@showUser');
//    $router->put('/boards/users/{boardUser}', 'Board\BoardController@updateUser');
    $router->delete('/boards/users/{boardUser}', 'Board\BoardController@destroyUser');

    //list
    $router->get('/lists/all/{boardId}', 'Lists\ListController@index');
    $router->post('/lists', 'Lists\ListController@store');
    $router->get('/lists/{list}', 'Lists\ListController@show');
    $router->put('/lists/{list}', 'Lists\ListController@update');
    $router->delete('/lists/{list}', 'Lists\ListController@destroy');

    //task
    $router->get('/tasks/all/{listId}', 'Task\TaskController@index');
    $router->post('/tasks', 'Task\TaskController@store');
    $router->get('/tasks/{task}', 'Task\TaskController@show');
    $router->put('/tasks/{task}', 'Task\TaskController@update');
    $router->delete('/tasks/{task}', 'Task\TaskController@destroy');

    //taskAssign
    $router->get('/tasks/assigns/all/{taskId}', 'Task\TaskController@indexAssign');
    $router->post('/tasks/assigns', 'Task\TaskController@storeUser');
    $router->get('/tasks/assigns/{boardUser}', 'Task\TaskController@showAssign');
    $router->delete('/tasks/assigns/{boardUser}', 'Task\TaskController@destroyAssign');

    //taskComment
    $router->get('/tasks/comments/all/{taskId}', 'Task\TaskController@indexComment');
    $router->post('/tasks/comments', 'Task\TaskController@storeComment');
    $router->get('/tasks/comments/{task}', 'Task\TaskController@showComment');
    $router->put('/tasks/comments/{task}', 'Task\TaskController@updateComment');
    $router->delete('/tasks/comments/{task}', 'Task\TaskController@destroyComment');

});
$router->post('/register','UsersController@register');
