<?php


namespace App\Services;


use App\Repositories\WorkspaceRepository;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;

class WorkspaceService
{
    use ApiResponser;
    protected $workspaceRepository;

    public function __construct(WorkspaceRepository $workspaceRepository)
    {
        $this->workspaceRepository = $workspaceRepository;
    }

    public function saveWorkspace($requestWorkspace, $userId)
    {
        $workspace = [
            'name' => $requestWorkspace['name'],
            'is_active' => true,
            'created_by_id' => $userId,
        ];

        $ws = $this->workspaceRepository->addWorkspace($workspace);

        $wsUserAdmin = ['workspace_id' => $ws['id'], 'user_id' => $userId, 'is_active' => true, 'create_by_id' => $userId];
        $this->saveWorkspaceUser($wsUserAdmin);
        $this->saveWorkspaceAdmin($wsUserAdmin);
        return $this->successResponse($ws, Response::HTTP_CREATED);
    }

    public function editWorkspace(int $id, $requestWorkspace)
    {
        $dbWorkspace = $this->workspaceRepository->getWorkspaceById($id);
        $dbWorkspace->fill($requestWorkspace->all());
        if ($dbWorkspace->isClean()) {
            return $this->errorResponse("Atleast one value must change", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $workspace = [
            'name' => $requestWorkspace['name'],
            'is_active' => $requestWorkspace['is_active'],
        ];

        if ($this->workspaceRepository->updateWorkspace($id, $workspace))
            $this->successResponse(null, Response::HTTP_NO_CONTENT);
        else
            $this->errorResponse('Couldn\'t update this workspace', Response::HTTP_BAD_REQUEST);
    }

    public function getWorkspace(int $id)
    {
        return $this->successResponse($this->workspaceRepository->getWorkspaceById($id));
    }

    public function getUserWorkspaces(int $userId)
    {
        $workspaceIds = $this->workspaceRepository->getWorkspaceUsersByUserId($userId)->get('workspace_id');

        return $this->successResponse($this->workspaceRepository->getWorkspacesByIds($workspaceIds));
    }

    public function removeWorkspace(int $id)
    {
        if ($this->workspaceRepository->deleteWorkspace($id))
            return $this->successResponse(null, Response::HTTP_NO_CONTENT);
        else
            return $this->errorResponse('Couldn\'t find this resource', Response::HTTP_NOT_FOUND);
    }

    public function saveWorkspaceUser($wsUser)
    {
        return $this->workspaceRepository->addWorkspaceUser($wsUser);
    }

    public function editWorkspaceUser(int $id, $wsUser)
    {
        $dbWorkspace = $this->workspaceRepository->getWorkspaceUser($id);
        $dbWorkspace->fill($wsUser->all());
        if ($dbWorkspace->isClean()) {
            return $this->errorResponse("At least one value must change", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $workspace = ['name' => $wsUser['name'], 'is_active' => $wsUser['is_active'],];

        if ($this->workspaceRepository->updateWorkspaceUser($id, $workspace))
            $this->successResponse(null, Response::HTTP_NO_CONTENT);
        else
            $this->errorResponse('Couldn\'t update this workspace User', Response::HTTP_BAD_REQUEST);
    }

    public function getWorkspaceUser(int $id)
    {
        return $this->successResponse($this->workspaceRepository->getWorkspaceUser($id));
    }

    public function getWorkspaceUsers($userId)
    {
        return $this->successResponse($this->workspaceRepository->getWorkspaceUsersByUserId($userId));
    }

    public function saveWorkspaceAdmin($wsAdmin)
    {
        return $this->workspaceRepository->addWorkspaceAdmin($wsAdmin);
    }

    public function editWorkspaceAdmin(int $id, $wsAdmin)
    {
        $dbWorkspaceAdmin = $this->workspaceRepository->getWorkspaceAdmin($id);
        $dbWorkspaceAdmin->fill($wsAdmin->all());
        if ($dbWorkspaceAdmin->isClean()) {
            return $this->errorResponse("At least one value must change", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $workspace = ['is_active' => $wsAdmin['is_active'],];

        if ($this->workspaceRepository->updateWorkspaceAdmin($id, $workspace))
            $this->successResponse(null, Response::HTTP_NO_CONTENT);
        else
            $this->errorResponse('Couldn\'t update this workspace Admin', Response::HTTP_BAD_REQUEST);
    }

    public function getWorkspaceAdmin(int $workspaceId)
    {
        return $this->successResponse($this->workspaceRepository->getWorkspaceAdmin($workspaceId));
    }

    public function getWorkspaceAdmins(int $workspaceId)
    {
        return $this->successResponse($this->workspaceRepository->getWorkspaceAdmins($workspaceId));
    }

    public function saveWorkspaceInvitation($wsInvitation)
    {
        $this->workspaceRepository->addWorkspaceInvitation($wsInvitation);
    }

    public function invitationEmailSetting(){

    }
}
