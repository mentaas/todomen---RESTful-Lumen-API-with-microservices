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

    //<editor-fold desc="Workspace">
    /**
     * @OA\Get(
     *     path="/workspaces",
     *     operationId="/workspaces",
     *     tags={"Workspaces"},
     *     @OA\Response(
     *         response="200",
     *         description="Returns all workspaces",
     *         @OA\JsonContent()
     *     ),
     *     security={{ "apiAuth": {} }}
     * )
     */
    public function index()
    {
        return $this->successResponse($this->workspaceService->obtainWorkspaces());
    }

    /**
     * @OA\Post(
     *     path="/workspaces",
     *   operationId="createWorkspace",
     *   tags={"Workspaces"},
     *   @OA\RequestBody(
     *         description="create workspace",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/NewWorkspace")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="pet response",
     *         @OA\JsonContent(ref="#/components/schemas/Workspace")
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="unexpected error",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorModel")
     *     ),
     *     security={{ "apiAuth": {} }}
     * )
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->workspaceService->createWorkspace($request->all()), Response::HTTP_CREATED);
    }

    public function show($id)
    {
        return $this->successResponse($this->workspaceService->obtainWorkspace($id), Response::HTTP_OK);
    }

    public function update($id, Request $request)
    {
        return $this->successResponse($this->workspaceService->editWorkspace($id, $request), Response::HTTP_NO_CONTENT);
    }

    public function destroy($id)
    {
        return $this->successResponse($this->workspaceService->deleteWorkspace($id), Response::HTTP_NO_CONTENT);
    }
    //</editor-fold>

    //<editor-fold desc="WorkspaceAdmin">
    public function indexAdmin($workspaceId)
    {
        return $this->successResponse($this->workspaceService->obtainWorkspaceAdmins($workspaceId));
    }

    public function storeAdmin(Request $request)
    {
        return $this->successResponse($this->workspaceService->createWorkspaceAdmin($request->all()), Response::HTTP_CREATED);
    }

    public function showAdmin($workspaceId, $userId)
    {
        return $this->successResponse($this->workspaceService->obtainWorkspaceAdmin($workspaceId, $userId), Response::HTTP_OK);
    }

    public function updateAdmin($workspaceAdmin, Request $request)
    {
        return $this->successResponse($this->workspaceService->editWorkspaceAdmin($workspaceAdmin, $request), Response::HTTP_NO_CONTENT);
    }

    public function destroyAdmin($workspaceAdmin)
    {
        return $this->successResponse($this->workspaceService->deleteWorkspaceAdmin($workspaceAdmin), Response::HTTP_NO_CONTENT);
    }
    //</editor-fold>

    //<editor-fold desc="WorkspaceUser">
    public function indexUser($workspaceId)
    {
        return $this->successResponse($this->workspaceService->obtainWorkspaceUsers($workspaceId));
    }

    public function storeUser(Request $request)
    {
        return $this->successResponse($this->workspaceService->createWorkspaceUser($request->all()), Response::HTTP_CREATED);
    }

    public function showUser($workspaceId, $userId)
    {
        return $this->successResponse($this->workspaceService->obtainWorkspaceUser($workspaceId, $userId), Response::HTTP_OK);
    }

    public function updateUser($id, Request $request)
    {
        return $this->successResponse($this->workspaceService->editWorkspaceUser($id, $request), Response::HTTP_NO_CONTENT);
    }

    public function destroyUser($workspaceUser)
    {
        return $this->successResponse($this->workspaceService->deleteWorkspaceAdmin($workspaceUser), Response::HTTP_NO_CONTENT);
    }
    //</editor-fold>

    //<editor-fold desc="WorkspaceInvitation">
    public function indexInvitation($statusId, $workspaceId)
    {
        return $this->successResponse($this->workspaceService->obtainWorkspaceInvitations($statusId, $workspaceId));
    }

    public function storeInvitation(Request $request)
    {
        return $this->successResponse($this->workspaceService->createWorkspaceInvitation($request->all()), Response::HTTP_CREATED);
    }

    public function destroyInvitation($workspaceInvitation)
    {
        return $this->successResponse($this->workspaceService->deleteWorkspaceInvitation($workspaceInvitation), Response::HTTP_NO_CONTENT);
    }
    //</editor-fold>
}
