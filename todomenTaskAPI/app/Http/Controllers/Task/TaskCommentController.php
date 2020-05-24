<?php


namespace App\Http\Controllers\Task;


use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskCommentController
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
            'comment'      => 'required_if:path',
            'path'    => 'required_if:comment',
        ];
        $this->validate($request, $rules);
        return $this->taskService->saveTaskComment($request->all(), $request->header('Authorization-Key'));
    }

    public function show($taskComment)
    {
        return $this->taskService->getTaskComment($taskComment);
    }

    public function update(Request $request, $taskComment)
    {
        $rules = [
            'comment'      => 'required_if:path',
            'path'    => 'required_if:comment',
        ];
        $this->validate($request, $rules);
        return $this->taskService->updateTaskComment($taskComment, $request->all());
    }

    public function destroy($taskComment)
    {
        return $this->taskService->deleteTaskComment($taskComment);
    }
}
