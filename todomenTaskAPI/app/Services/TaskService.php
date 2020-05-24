<?php


namespace App\Services;


use App\Repositories\TaskRepository;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;

class TaskService
{
    use ApiResponser;
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
//        set_exception_handler(array('App\Services\TaskService','exception_handler'));
    }

//    public static function exception_handler(\Exception $e) {
//        return \response()->json(['error' => $e->getMessage(), 'code' => Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);
//    }

    public function saveTask($task, $user_id)
    {
        $new_task = [
            'name' => $task['name'],
            'description' => $task['description'],
            'list_id' => $task['list_id'],
//            'priority_id' => $task['priority_id'],
            'has_deadline' => isset($task['has_deadline']) ? $task['has_deadline']: false,
            'deadline_date' => isset($task['deadline_date']) ? $task['deadline_date']: null,
            'created_by_id' => $user_id
        ];
        return $this->successResponse($this->taskRepository->addTask($new_task), Response::HTTP_CREATED);
    }

    public function updateTask(int $id, $task)
    {
        return $this->successResponse($this->taskRepository->updateTask($id, $task), Response::HTTP_NO_CONTENT);
    }

    public function getTask(int $id)
    {
        return $this->successResponse($this->taskRepository->getTask($id));
    }

    public function getTasks(int $list_id){
        return $this->successResponse($this->taskRepository->getTasks($list_id));
    }

    public function deleteTask(int $id)
    {
        return $this->successResponse($this->taskRepository->deleteTask($id), Response::HTTP_NO_CONTENT);
    }


    public function saveTaskAssign($taskAssign, $user_id)
    {
        $newTaskAssign = [
            'task_id' => $taskAssign['task_id'],
            'assign_to_id' => $taskAssign['assign_to_id'],
            'created_by_id' => $user_id,
        ];
        return $this->successResponse($this->taskRepository->addTaskAssign($newTaskAssign), Response::HTTP_CREATED);
    }

    public function getTaskAssign(int $id)
    {
        return $this->successResponse($this->taskRepository->getTaskAssign($id));
    }

    public function getTaskAssigns(int $task_id){
        return $this->successResponse($this->taskRepository->getTaskAssigns($task_id));
    }

    public function deleteTaskAssign(int $id)
    {
        return $this->successResponse($this->taskRepository->deleteTaskAssign($id), Response::HTTP_NO_CONTENT);
    }


    public function saveTaskComment($task_comment, $user_id)
    {
        $new_task_comment = [
            'name' => $task_comment['name'],
            'description' => $task_comment['description'],
            'list_id' => $task_comment['list_id'],
            'priority_id' => $task_comment['priority_id'],
            'created_by_id' => $user_id
        ];
        return $this->successResponse($this->taskRepository->addTaskComment($new_task_comment), Response::HTTP_CREATED);
    }

    public function updateTaskComment(int $id, $task_comment)
    {
        return $this->successResponse($this->taskRepository->updateTaskComment($id, $task_comment), Response::HTTP_NO_CONTENT);
    }

    public function getTaskComment(int $id)
    {
        return $this->successResponse($this->taskRepository->getTaskComment($id));
    }

    public function getTaskComments(int $task_id){
        return $this->successResponse($this->taskRepository->getTaskComments($task_id));
    }

    public function deleteTaskComment(int $id)
    {
        return $this->successResponse($this->taskRepository->deleteTaskComment($id), Response::HTTP_NO_CONTENT);
    }
}
