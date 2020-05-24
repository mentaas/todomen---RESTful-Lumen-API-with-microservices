<?php


namespace App\Repositories;


use App\Models\Task;
use App\Models\TaskAssign;
use App\Models\TaskComment;

class TaskRepository
{
    protected $task;
    protected $taskAssign;
    protected $taskComment;

    public function __construct(Task $task, TaskAssign $taskAssign, TaskComment $taskComment)
    {
        $this->task = $task;
        $this->taskAssign = $taskAssign;
        $this->taskComment = $taskComment;
    }

    public function addTask($task)
    {
        return $this->task->create($task);
    }

    public function updateTask(int $id, $task)
    {
        $taskDb = $this->getTask($id);
        return $taskDb->update([
            'name' => $task['name'],
            'description' => $task['description'],
            'list_id' => $task['list_id'],
            'priority_id' => $task['priority_id'],
            'has_deadline' => $task['has_deadline'],
            'deadline_date' => $task['deadline_date']
        ]);
    }

    public function getTasks(int $list_id)
    {
        return $this->task->where('list_id', $list_id)->get();
    }

    public function getTask(int $id)
    {
        return $this->task->findOrFail($id);
    }

    public function deleteTask(int $id)
    {
        return $this->task->delete($id);
    }


    //taskAssign
    public function addTaskAssign($task_assign)
    {
        return $this->taskAssign->create($task_assign);
    }

    public function getTaskAssigns(int $task_id)
    {
        return $this->task->where('task_id', $task_id)->get();
    }

    public function getTaskAssign(int $id)
    {
        return $this->task->findOrFail($id);
    }

    public function deleteTaskAssign(int $id)
    {
        return $this->taskAssign->delete($id);
    }

    //taskComment
    public function addTaskComment($task_comment)
    {
        return $this->taskComment->create($task_comment);
    }

    public function updateTaskComment(int $id, $task_comment)
    {
        $taskCommentDb = $this->getTaskComment($id);
        return $taskCommentDb->update([
            'comment' => $task_comment['comment'],
            'path' => $task_comment['path'],
        ]);
    }

    public function getTaskComments(int $task_id)
    {
        return $this->taskComment->where('task_id', $task_id)->get();
    }

    public function getTaskComment(int $id)
    {
        return $this->taskComment->findOrFail($id);
    }

    public function deleteTaskComment(int $id)
    {
        return $this->taskComment->delete($id);
    }
}
