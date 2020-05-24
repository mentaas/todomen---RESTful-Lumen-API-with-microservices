<?php


namespace App\Http\Controllers\Task;


use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index($workspaceId)
    {
        return $this->taskService->getTasks($workspaceId);
    }

    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required|max:254',
            'list_id'    => 'required',
        ];
        $this->validate($request, $rules);
        return $this->taskService->saveTask($request->all(), $request->header('Authorization-Key'));
    }

    public function show($task)
    {
        return $this->taskService->getTask($task);
    }

    public function update(Request $request, $task)
    {
        $rules = [
            'name'      => 'required|max:254',
            'list_id'   => 'required'
        ];
        $this->validate($request, $rules);
        return $this->taskService->updateTask($task, $request->all());
    }

    public function destroy($task)
    {
        return $this->taskService->deleteTask($task);
    }
}
