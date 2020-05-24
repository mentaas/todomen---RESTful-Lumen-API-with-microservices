<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    protected $table = "todomen_task_db.task_comments";

    protected $fillable = [
        'task_id', 'comment', 'path', 'created_by_id'
    ];

    protected $hidden = [];

}
