<?php


namespace App\Http\Controllers\Task;


use App\Services\TaskService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class TaskController
{
    use ApiResponser;
    protected $taskService;
    public function __construct(TaskService $taskService, Request $request)
    {
        $this->taskService = $taskService;
        $this->taskService->userId = $request->user()->id;
    }

    //<editor-fold desc="Task">
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
    public function index($listId)
    {
        return $this->successResponse($this->taskService->obtainTasks($listId));
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
        return $this->successResponse($this->taskService->createTask($request->all()));
    }

    public function show($task)
    {
        return $this->successResponse($this->taskService->obtainTask($task));
    }

    public function update(Request $request, $task)
    {
        return $this->successResponse($this->taskService->editTask($task, $request->all()));
    }

    public function destroy($task)
    {
        return $this->taskService->deleteTask($task);
        return $this->successResponse($this->taskService->deleteTask($task));
    }
    //</editor-fold>

    //<editor-fold desc="TaskAssign">
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
    public function indexAssign($taskId)
    {
        return $this->successResponse($this->taskService->obtainTaskAssigns($taskId));
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
    public function storeAssign(Request $request)
    {
        return $this->successResponse($this->taskService->createTaskAssign($request->all()));
    }

    public function showAssign($taskAssign)
    {
        return $this->successResponse($this->taskService->obtainTaskAssign($taskAssign));
    }

    public function destroyAssign($taskAssign)
    {
        return $this->successResponse($this->taskService->deleteTaskAssign($taskAssign));
    }
    //</editor-fold>

    //<editor-fold desc="TaskComment">
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
    public function indexComment($taskId)
    {
        return $this->successResponse($this->taskService->obtainTaskComments($taskId));
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
    public function storeComment(Request $request)
    {
        return $this->successResponse($this->taskService->createTaskComment($request));
    }

    public function showComment($task)
    {
        return $this->successResponse($this->taskService->obtainTaskComment($task));
    }

    public function updateComment(Request $request, $task)
    {
        return $this->successResponse($this->taskService->editTaskComment($task, $request->all()));
    }

    public function destroyComment($task)
    {
        return $this->successResponse($this->taskService->deleteTaskComment($task));
    }
    //</editor-fold>

}
