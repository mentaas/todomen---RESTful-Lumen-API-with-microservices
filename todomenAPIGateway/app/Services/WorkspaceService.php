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

    public function obtainWorkspaces()
    {
        return $this->performRequest('GET', '/workspaces');
    }

    public function createWorkspace($data)
    {
        return $this->performRequest('POST', '/workspaces', $data);
    }

}
