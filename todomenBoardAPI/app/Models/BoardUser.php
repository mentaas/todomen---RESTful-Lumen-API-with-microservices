<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * Workspace
 *
 * @mixin Eloquent
 */

class BoardUser extends Model
{
    protected $table = 'todomen_board_db.board_users';

    protected $fillable = [
        'board_id', 'user_id', 'created_by_id'
    ];
}

