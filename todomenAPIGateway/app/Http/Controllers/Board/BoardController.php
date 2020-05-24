<?php


namespace App\Http\Controllers\Board;


use App\Services\BoardService;
use App\Traits\ApiResponser;
use App\Utils\FormatApiResponse;
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
        $response = $this->boardService->obtainBoards($workspaceId);
        return $this->successResponse($response->data, $response->code);
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
        $response = $this->boardService->createBoard($request->all());
        return $this->successResponse($response->data, $response->code);
    }

    public function show($board)
    {
        $response = $this->boardService->obtainBoard($board);
        return $this->successResponse($response->data, $response->code);
    }

    public function update(Request $request, $board)
    {
        $response = $this->boardService->editBoard($board, $request->all());
        return $this->successResponse($response->data, $response->code);
    }

    public function destroy($board)
    {
        $res = $this->boardService->deleteBoard($board);
        return $this->successResponse($res->data, $res->code);
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
        $response = $this->boardService->obtainBoardUsers($boardId);
        return $this->successResponse($response->data, $response->code);
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
        $response = $this->boardService->createBoardUser($request->all());
        return $this->successResponse($response->data, $response->code);
    }

    public function showUser($boardUser)
    {
        $response = $this->boardService->obtainBoardUser($boardUser);
        return $this->successResponse($response->data, $response->code);
    }

    public function updateUser(Request $request, $boardUser)
    {
        $response = $this->boardService->editBoardUser($boardUser, $request->all());
        return $this->successResponse($response->data, $response->code);
    }

    public function destroyUser($boardUser)
    {
        $response = $this->boardService->deleteBoardUser($boardUser);
        return $this->successResponse($response->data, $response->code);
    }
    //</editor-fold>

}
