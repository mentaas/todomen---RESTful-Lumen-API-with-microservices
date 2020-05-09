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

class Board extends Model
{
    protected $table = 'todomen_board_db.boards';

    protected $fillable = [
        'name', 'workspace_id', 'admin_user_id', 'created_by_id',
    ];
}
