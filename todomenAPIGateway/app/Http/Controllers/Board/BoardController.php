<?php


namespace App\Http\Controllers\Board;


use App\Services\BoardService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function GuzzleHttp\Promise\all;

class BoardController
{
    use ApiResponser;
    protected $boardService;
    public function __construct(BoardService $boardService, Request $request)
    {
        $this->boardService = $boardService;
        $this->boardService->userId = $request->user()->id;
    }

    //<editor-fold desc="Board">
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
    public function index($workspaceId)
    {
        return $this->successResponse($this->boardService->obtainBoards($workspaceId));
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
        return $this->successResponse($this->boardService->createBoard($request->all()));
    }

    public function show($board)
    {
        return $this->successResponse($this->boardService->obtainBoard($board));
    }

    public function update(Request $request, $board)
    {
        return $this->successResponse($this->boardService->editBoard($board, $request->all()));
    }

    public function destroy($board)
    {
        return $this->successResponse($this->boardService->deleteBoard($board));
    }
    //</editor-fold>

    //<editor-fold desc="BoardUser">
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
    public function indexUser($boardId)
    {
        return $this->successResponse($this->boardService->obtainBoardUsers($boardId));
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
    public function storeUser(Request $request)
    {
        return $this->successResponse($this->boardService->createBoardUser($request->all()));
    }

    public function showUser($boardUser)
    {
        return $this->successResponse($this->boardService->obtainBoardUser($boardUser));
    }

    public function updateUser(Request $request, $boardUser)
    {
        return $this->successResponse($this->boardService->editBoardUser($boardUser, $request->all()));
    }

    public function destroyUser($boardUser)
    {
        return $this->successResponse($this->boardService->deleteBoardUser($boardUser));
    }
    //</editor-fold>

}
