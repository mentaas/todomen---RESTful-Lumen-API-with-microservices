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
    return $router->app->version() . " WorkspaceAPI";
});

$router->get('/workspaces', 'Workspace\WorkspaceController@index');
$router->post('/workspaces', 'Workspace\WorkspaceController@store');
$router->get('/workspaces/{workspace}', 'Workspace\WorkspaceController@show');
$router->put('/workspaces/{workspace}', 'Workspace\WorkspaceController@update');
$router->delete('/workspaces/{workspace}', 'Workspace\WorkspaceController@destroy');

$router->get('/workspaces/admins/{workspaceId}', 'Workspace\WorkspaceAdminController@index');
$router->post('/workspaces/admin', 'Workspace\WorkspaceAdminController@store');
$router->get('/workspaces/admin/{workspaceId}', 'Workspace\WorkspaceAdminController@show');
$router->put('/workspaces/admin/{workspaceAdmin}', 'Workspace\WorkspaceAdminController@update');
$router->delete('/workspaces/admin/{workspaceAdmin}', 'Workspace\WorkspaceAdminController@destroy');

$router->get('/workspaces/users/{userId}', 'Workspace\WorkspaceUserController@index');
$router->post('/workspaces/users', 'Workspace\WorkspaceUserController@store');
$router->get('/workspaces/admin/{userId}', 'Workspace\WorkspaceUserController@show');
$router->put('/workspaces/admin/{workspaceUser}', 'Workspace\WorkspaceUserController@update');
$router->delete('/workspaces/admin/{workspaceUser}', 'Workspace\WorkspaceUserController@destroy');


$router->get('workspaces/invitations/{statusId}/{workspaceId}', 'Workspace\WorkspaceInvitationController@index');
$router->post('/workspaces/invitations', 'Workspace\WorkspaceInvitationController@store');
$router->get('workspaces/invitations/accept', 'Workspace\WorkspaceInvitationController@invitationAccept');
$router->delete('workspaces/invitations/{invitation}', 'Workspace\WorkspaceInvitationController@destroy');
