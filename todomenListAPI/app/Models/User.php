<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class ListModel extends Model {
    protected $table = "todomen_list_db.lists";
    protected $fillable = [
        'name', 'board_id', 'created_by_id',
    ];

    protected $hidden = [];
}
