<?php


namespace App\Services;


use App\Traits\ConsumeExternalService;
use Illuminate\Http\Request;

class TaskService
{
    use ConsumeExternalService;

    public $baseUri;
    public $secret;
    public $userId;


    public function __construct()
    {
        $this->baseUri = config('services.tasks.base_uri');
        $this->secret = config('services.tasks.secret');

       set_exception_handler(array('App\Services\TaskService','exception_handler'));
    }

    public static function exception_handler(\Throwable $e) {
        return \response()->json(['error' => $e->getMessage(), 'code' => Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);
    }

    //<editor-fold desc="task">

    public function obtainTasks($list_id)
    {
        return $this->performRequest('GET', "/tasks/all/{$list_id}");
    }

    public function createTask($data)
    {
        return $this->performRequest('POST', '/tasks', $data);
    }

    public function obtainTask($id)
    {
        return $this->performRequest('GET', "/tasks/{$id}");
    }

    public function editTask($id, $data)
    {
        return $this->performRequest('PUT', "tasks/{$id}", $data);
    }

    public function deleteTask($id)
    {
        return $this->performRequest('DELETE', "tasks/{$id}");
    }

    //</editor-fold>

    //<editor-fold desc="taskAssign">

    public function obtainTaskAssigns($task_id)
    {
        return $this->performRequest('GET', "/tasks/assigns/all/{$task_id}");
    }

    public function createTaskAssign($data)
    {
        return $this->performRequest('POST', '/tasks/assigns', $data);
    }

    public function obtainTaskAssign($id)
    {
        return $this->performRequest('GET', "/tasks/assigns/{$id}");
    }

    public function deleteTaskAssign($id)
    {
        return $this->performRequest('DELETE', "tasks/assigns/{$id}");
    }

    //</editor-fold>

    //<editor-fold desc="board">

    public function obtainTaskComments($workspaceId)
    {
        return $this->performRequest('GET', "/tasks/comments/all/{$workspaceId}");
    }

    public function createTaskComment(Request $data)
    {
        return $this->performRequest('POST', '/tasks/comments', $data);
    }

    public function obtainTaskComment($id)
    {
        return $this->performRequest('GET', "/tasks/comments/{$id}");
    }

    public function editTaskComment($id, $data)
    {
        return $this->performRequest('PUT', "tasks/comments/{$id}", $data);
    }

    public function deleteTaskComment($id)
    {
        return $this->performRequest('DELETE', "tasks/comments/{$id}");
    }

    //</editor-fold>


}
