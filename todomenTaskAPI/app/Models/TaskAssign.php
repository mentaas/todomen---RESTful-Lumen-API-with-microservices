<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TaskAssign extends Model
{
    protected $table = "todomen_task_db.task_assigns";

    protected $fillable = [
        'task_id', 'assign_to_id', 'created_by_id',
    ];

    protected $hidden = [];
}
