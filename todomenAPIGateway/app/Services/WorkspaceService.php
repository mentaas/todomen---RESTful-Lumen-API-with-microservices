<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;

class WorkspaceService
{
    use ConsumeExternalService;

    public $baseUri;
    public $secret;
    public $userId;


    public function __construct()
    {
        $this->baseUri = config('services.workspaces.base_uri');
        $this->secret = config('services.workspaces.secret');
    }

    //<editor-fold desc="Workspace">

    public function obtainWorkspaces()
    {
        return $this->performRequest('GET', '/workspaces');
    }

    public function createWorkspace($data)
    {
        return $this->performRequest('POST', '/workspaces', $data);
    }

    public function obtainWorkspace($id)
    {
        return $this->performRequest('GET', "/workspaces/{$id}");
    }

    public function editWorkspace($id, $data)
    {
        return $this->performRequest('PUT', "workspaces/{$id}", $data);
    }

    public function deleteWorkspace($id)
    {
        return $this->performRequest('DELETE', "workspaces/{$id}");
    }

//</editor-fold>

    //<editor-fold desc="WorkspaceAdmin">
    public function obtainWorkspaceAdmins($workspaceId)
    {
        return $this->performRequest('GET', "/workspaces/admins/{$workspaceId}");
    }

    public function createWorkspaceAdmin($data)
    {
        return $this->performRequest('POST', '/workspaces/admins', $data);
    }

    public function obtainWorkspaceAdmin($workspaceId, $userId)
    {
        return $this->performRequest('GET', "workspaces/admins/{$workspaceId}/{$userId}");
    }

    public function editWorkspaceAdmin($id, $data)
    {
        return $this->performRequest('PUT', "workspaces/admins/{$id}", $data);
    }

    public function deleteWorkspaceAdmin($id)
    {
        return $this->performRequest('DELETE', "workspaces/admins/{$id}");
    }

    //</editor-fold>

    //<editor-fold desc="WorkspaceUser">
    public function obtainWorkspaceUsers($workspaceId)
    {
        return $this->performRequest('GET', "/workspaces/users/{$workspaceId}");
    }

    public function createWorkspaceUser($data)
    {
        return $this->performRequest('POST', '/workspaces/users', $data);
    }

    public function obtainWorkspaceUser($workspaceId, $userId)
    {
        return $this->performRequest('GET', "workspaces/users/{$workspaceId}/{$userId}");
    }

    public function editWorkspaceUser($id, $data)
    {
        return $this->performRequest('PUT', "workspaces/users/{$id}", $data);
    }

    public function deleteWorkspaceUser($id)
    {
        return $this->performRequest('DELETE', "workspaces/users/{$id}");
    }

    //</editor-fold>

    //<editor-fold desc="WorkspaceInvitation">
    public function obtainWorkspaceInvitations($statusId, $workspaceId)
    {
        return $this->performRequest('GET', "/workspaces/invitations/{$statusId}/{$workspaceId}");
    }

    public function createWorkspaceInvitation($data)
    {
        return $this->performRequest('POST', '/workspaces/invitations', $data);
    }

    public function deleteWorkspaceInvitation($id)
    {
        return $this->performRequest('DELETE', "workspaces/invitations/{$id}");
    }

    //</editor-fold>

}
