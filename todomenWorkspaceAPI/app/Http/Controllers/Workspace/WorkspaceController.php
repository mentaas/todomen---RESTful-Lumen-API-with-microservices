<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use App\Services\WorkspaceService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WorkspaceController extends Controller
{
    use ApiResponser;

    protected $workspaceService;
    protected $request;

    public function __construct(WorkspaceService $workspaceService, Request $request)
    {
        $this->workspaceService = $workspaceService;
        $this->request = $request;
    }

    public function index(){
        return $this->workspaceService->getUserWorkspaces($this->request->header('Authorization-Key'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required|max:254',
            'expire_date' => 'date_format:Y-m-d H:i:s',
        ];

        $this->validate($request, $rules);
        return $this->workspaceService->saveWorkspace($request, $this->request->header('Authorization-Key'));
    }

    public function show($workspace, $userId)
    {
        return $this->workspaceService->getWorkspace($workspace);
    }

    public function update(Request $request, $workspace)
    {
        $rules = [
            'name'      => 'max:254',
            'is_active'    => 'required',
        ];
        $this->validate($request, $rules);

        return $this->workspaceService->editWorkspace($workspace, $request);
    }

    public function destroy($workspace)
    {
        return $this->workspaceService->removeWorkspace($workspace);
    }


}
