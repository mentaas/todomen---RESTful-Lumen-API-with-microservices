<?php


namespace App\Http\Controllers\Workspace;


use App\Http\Controllers\Controller;
use App\Services\WorkspaceService;
use Illuminate\Http\Request;

class WorkspaceInvitationController extends Controller
{
    use ApiResponser;

    protected $workspaceService;
    protected $request;

    public function __construct(WorkspaceService $workspaceService, Request $request)
    {
        $this->workspaceService = $workspaceService;
        $this->request = $request;
    }

    public function index($wsInvitationStatusId, $workspaceId){
        return $this->workspaceService->getWorkspaceInvitationByStatus($wsInvitationStatusId, $workspaceId);
    }

    public function store(Request $request)
    {
        $rules = [
            'workspace_id' => 'required',
            'email_address' => 'required',
        ];

        $this->validate($request, $rules);
        return $this->workspaceService->invitationEmailSetting($request->all());
    }

    public function show($workspaceInvitation)
    {
        return $this->workspaceService->getWorkspaceInvitation($workspaceInvitation);
    }

    public function invitationAccept(Request $request){
        $x = $request->query('x');
        $y = $request->query('y');

        return $this->workspaceService->acceptedInvitation($x, $y);
    }

    public function destroy($workspace)
    {
        return $this->workspaceService->removeWorkspaceInvitation($workspace);
    }
}
