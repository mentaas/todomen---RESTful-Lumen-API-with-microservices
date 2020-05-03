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

class Workspace extends Model
{
    protected $table = 'todomen_workspace_db.workspaces';

    protected $fillable = [
        'name', 'is_active', 'expire_date', 'created_by_id'
    ];
}
