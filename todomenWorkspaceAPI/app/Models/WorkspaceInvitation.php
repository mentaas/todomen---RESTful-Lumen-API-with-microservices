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

class WorkspaceInvitation extends Model
{
    protected $table = 'todomen_workspace_db.workspace_invitations';

    protected $fillable = [
        'workspace_id', 'user_id', 'status_id',
    ];
}
