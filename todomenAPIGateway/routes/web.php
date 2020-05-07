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
});
$router->post('/register','UsersController@register');
