<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "todomen_task_db.tasks";

    protected $fillable = [
        'name', 'description', 'list_id', 'created_by_id', 'has_deadline', 'deadline_date',
    ];

    protected $hidden = [];

}
