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

class WorkspaceUser extends Model
{
    protected $table = 'todomen_workspace_db.workspace_users';

    protected $fillable = [
        'workspace_id', 'user_id', 'is_active', 'create_by_id',
    ];
}
