<?php


namespace App\Http\Controllers\Lists;


use App\Services\ListService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ListController
{
    use ApiResponser;
    protected $listService;
    public function __construct(ListService $listService, Request $request)
    {
        $this->listService = $listService;
        $this->listService->userId = $request->user()->id;
    }

    //<editor-fold desc="List">
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
    public function index($boardId)
    {
        return $this->successResponse($this->listService->obtainLists($boardId));
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
        return $this->successResponse($this->listService->createList($request->all()));
    }

    public function show($list)
    {
        return $this->successResponse($this->listService->obtainList($list));
    }

    public function update(Request $request, $list)
    {
        return $this->successResponse($this->listService->editList($list, $request->all()));
    }

    public function destroy($list)
    {
        return $this->successResponse($this->listService->deleteList($list));
    }
    //</editor-fold>
}
