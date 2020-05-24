<?php


namespace App\Http\Controllers\Task;


use App\Http\Controllers\Controller;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
        set_exception_handler(function ($e) {
            abort(404);
        });
    }

    public static function exception_handler(\Exception $e) {
        return \response()->json(['error' => $e->getMessage(), 'code' => Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);
    }
    public function index($listId)
    {
        return $this->taskService->getTasks($listId);
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
