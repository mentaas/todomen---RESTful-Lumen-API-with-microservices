<?php


namespace App\Repositories;

use App\Models\Workspace;
use App\Models\WorkspaceAdmin;
use App\Models\WorkspaceUser;
use App\Models\WorkspaceInvitation;

class WorkspaceRepository
{
    protected $workspace;
    protected $workspaceAdmin;
    protected $workspaceUser;
    protected $workspaceInvitation;

    public function __construct(Workspace $workspace, WorkspaceAdmin $workspaceAdmin, WorkspaceUser $workspaceUser, WorkspaceInvitation $workspaceInvitation)
    {
        $this->workspace = $workspace;
        $this->workspaceAdmin = $workspaceAdmin;
        $this->workspaceUser = $workspaceUser;
        $this->workspaceInvitation = $workspaceInvitation;
    }

    public function addWorkspace($workspace){
        return $this->workspace->create($workspace);
    }

    public function updateWorkspace(int $id, $workspace): bool {
        try{
            $dbWorkspace = $this->getWorkspaceById($id);
            $dbWorkspace->update([
                'name' => $workspace['name'],
                'is_active' => $workspace['is_active']
            ]);

            return true;
        }catch(\Exception $ex)
        {
            return false;
        }
    }

    public function getWorkspaceById(int $id){
        return $this->workspace->findOrFail($id);
    }

    public function getWorkspaces(){
        return $this->workspace->orderBy('id', 'DESC')->get();
    }

    public function getWorkspacesByIds($idsArray)
    {
        return $this->workspace->find($idsArray);
    }

    public function deleteWorkspace(int $id)
    {
        $workspace = $this->workspace->where('id', $id);
        if ($workspace != null)
            return $workspace->delete();
    }

    public function getWorkspaceAdmin(int $workspaceId){
        return $this->workspaceAdmin->where('workspace_id', $workspaceId)->first();
    }

    public function getWorkspaceAdmins(int $workspaceId){
        return $this->workspaceAdmin->where('workspace_id', $workspaceId)->get();
    }

    public function addWorkspaceAdmin($workspaceAdmin){
        return $this->workspaceAdmin->create($workspaceAdmin);
    }

    public function updateWorkspaceAdmin(int $id, $workspaceAdmin){
        $dbWorkspaceAdmin = $this->getWorkspaceAdmin($id);
        return $dbWorkspaceAdmin->update(['is_active' => $workspaceAdmin['is_active']]);
    }

    public function deleteWorkspaceAdmin(int $id){
        $workspaceAdmin = $this->workspaceAdmin->where('id', $id);
        if ($workspaceAdmin != null)
            return $workspaceAdmin->delete();
    }

    public function getWorkspaceUser($id){
        return $this->workspaceUser->findOrFail($id);
    }

    public function getWorkspaceUsersByWorkspaceId(int $workspaceUserId){
        return $this->workspaceUser->where('workspace_id', $workspaceUserId)->get();
    }

    public function getWorkspaceUsersByUserId(int $userId){
        return $this->workspaceUser->where('user_id', $userId);
    }

    public function addWorkspaceUser($workspaceUser){
        return $this->workspaceUser->create($workspaceUser);
    }

    public function updateWorkspaceUser(int $id, $workspaceUser){
        $dbWorkspaceUser = $this->getWorkspaceUser($id);
        return $dbWorkspaceUser->update(['is_active' => $workspaceUser['is_active']]);
    }

    public function deleteWorkspaceUser(int $id){
        $workspaceUser = $this->workspaceUser->where('id', $id);
        if ($workspaceUser != null)
            return $workspaceUser->delete();
    }

    public function getWorkspaceInvitation(int $id){
        return $this->workspaceInvitation->findOrFail($id);
    }

    public function getWorkspaceInvitationByStatusId(int $statusId, int $workspaceId){
        return $this->workspaceInvitation->where(['status_id', '=', $statusId], ['workspace_id', '=', $workspaceId])->get();
    }

    public function addWorkspaceInvitation($workspaceInvitation){
        return $this->workspaceInvitation->create($workspaceInvitation);
    }

    public function updateWorkspaceInvitation(int $id, $workspaceInvitation){
        $dbWorkspaceInvitation = $this->getWorkspaceInvitation($id);
        $dbWorkspaceInvitation->update(['status_id'=> $workspaceInvitation['status_id']]);
    }

    public function deleteWorkspaceInvitation(int $id){
        $workspaceInvitation = $this->getWorkspaceInvitation($id);
        if($workspaceInvitation != null)
            return $workspaceInvitation->delete();
    }




}
