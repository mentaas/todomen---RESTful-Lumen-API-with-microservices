<?php


namespace App\Http\Controllers\Task;


use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskAssignController
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index($workspaceId)
    {
        return $this->taskService->getTaskComments($workspaceId);
    }

    public function store(Request $request)
    {
        $rules = [
            'task_id'      => 'required',
            'assign_to_id'    => 'required',
        ];
        $this->validate($request, $rules);
        return $this->taskService->saveTaskComment($request->all(), $request->header('Authorization-Key'));
    }

    public function show($taskComment)
    {
        return $this->taskService->getTaskComment($taskComment);
    }


    public function destroy($taskComment)
    {
        return $this->taskService->deleteTaskComment($taskComment);
    }
}
