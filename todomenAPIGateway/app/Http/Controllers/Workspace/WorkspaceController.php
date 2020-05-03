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
    public function __construct(WorkspaceService $workspaceService, Request $request)
    {
        $this->workspaceService = $workspaceService;
        $this->workspaceService->userId = $request->user()->id;
    }

    public function index()
    {
        return $this->successResponse($this->workspaceService->obtainWorkspaces());
    }

    public function store(Request $request)
    {
        return $this->successResponse($this->workspaceService->createWorkspace($request->all()), Response::HTTP_CREATED);
    }
}
