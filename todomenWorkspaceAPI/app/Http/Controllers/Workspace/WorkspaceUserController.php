<?php


namespace App\Http\Controllers\Workspace;


use App\Http\Controllers\Controller;
use App\Services\WorkspaceService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class WorkspaceUserController extends Controller
{
    use ApiResponser;

    protected $workspaceService;
    protected $request;

    public function __construct(WorkspaceService $workspaceService, Request $request)
    {
        $this->workspaceService = $workspaceService;
        $this->request = $request;
    }

    public function index($workspaceId){
        return $this->workspaceService->getWorkspaceUsers($workspaceId);
    }

    public function store(Request $request)
    {
        $rules = [
            'workspace_id' => 'required',
            'user_id' => 'required',
        ];

        $this->validate($request, $rules);
        return $this->workspaceService->saveWorkspaceUserResponse($request);
    }

    public function show($workspace)
    {
        return $this->workspaceService->getWorkspaceUser($workspace);
    }

    public function update(Request $request, $workspace)
    {
        $rules = [
            'is_active' => 'required',
        ];
        $this->validate($request, $rules);
        return $this->workspaceService->editWorkspaceUser($workspace, $request);
    }

    public function destroy($workspace)
    {
        return $this->workspaceService->removeWorkspaceUser($workspace);
    }
}
