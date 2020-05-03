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

class WorkspaceAdmin extends Model
{
    protected $table = 'todomen_workspace_db.workspace_admins';

    protected $fillable = [
      'workspace_id', 'user_id', 'is_active', 'create_by_id',
    ];
}
