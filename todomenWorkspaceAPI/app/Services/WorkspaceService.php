<?php


namespace App\Services;


use App\Enums\WorkspaceInvitationStatus;
use App\Mail\SendMail;
use App\Repositories\WorkspaceRepository;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

    public function saveWorkspaceUserResponse($wsUser)
    {
        return $this->successResponse($this->saveWorkspaceUser($wsUser));
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

    public function removeWorkspaceUser(int $id)
    {
        if ($this->workspaceRepository->deleteWorkspaceUser($id))
            return $this->successResponse(null, Response::HTTP_NO_CONTENT);
        else
            return $this->errorResponse('Couldn\'t find this resource', Response::HTTP_NOT_FOUND);
    }

    public function getWorkspaceUser(int $id)
    {
        return $this->successResponse($this->workspaceRepository->getWorkspaceUser($id));
    }

    public function getWorkspaceUsers($workspaceId)
    {
        return $this->successResponse($this->workspaceRepository->getWorkspaceUsersByWorkspaceId($workspaceId));
    }

    public function saveWorkspaceAdmin($wsAdmin)
    {
        return $this->workspaceRepository->addWorkspaceAdmin($wsAdmin);
    }

    public function saveWorkspaceAdminResponse($wsUser)
    {
        return $this->successResponse($this->saveWorkspaceUser($wsUser));
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

    public function removeWorkspaceAdmin(int $id)
    {
        if ($this->workspaceRepository->deleteWorkspaceAdmin($id))
            return $this->successResponse(null, Response::HTTP_NO_CONTENT);
        else
            return $this->errorResponse('Couldn\'t find this resource', Response::HTTP_NOT_FOUND);
    }

    public function getWorkspaceAdmin(int $workspaceId, int $userId)
    {
        return $this->successResponse($this->workspaceRepository->getWorkspaceAdmin($workspaceId, $userId));
    }

    public function getWorkspaceAdmins(int $workspaceId)
    {
        return $this->successResponse($this->workspaceRepository->getWorkspaceAdmins($workspaceId));
    }

    public function saveWorkspaceInvitation($wsInvitation)
    {
        $wsInvitation['status_id'] = WorkspaceInvitationStatus::Pending;
        return $this->workspaceRepository->addWorkspaceInvitation($wsInvitation);
    }

    public function invitationEmailSetting($wsInvitation)
    {
        $workspaceInvitation = $this->saveWorkspaceInvitation($wsInvitation);
        $hashedEmail = sha1($workspaceInvitation['email_address']);
        $hashedSalt = sha1(env('EMAIL_SALT'));
        $link = env('APP_URL') . "/workspaces/invitations/accept?x=" . $hashedEmail . "&y=" . $hashedSalt;
        $workspaceName = json_decode(json_encode($this->getWorkspace($workspaceInvitation['workspace_id'])), true);
        $this->sendInvitationEmail($workspaceInvitation['email_address'], $link, $workspaceName['original']['data']['name']);

        return $this->successResponse($workspaceInvitation, Response::HTTP_CREATED);
    }

    public function sendInvitationEmail($email, $link, $workspace)
    {
        $title = '[Invitation] You\'re very welcome to todomen';
        $invitation_details = [
            'email' => $email
        ];
        $content_details = [
            'link' => $link,
            'workspace' => $workspace,
        ];

        $sendmail = Mail::to($invitation_details['email'])->send(new SendMail($title, $invitation_details, $content_details));
    }

    public function acceptedInvitation($hashedEmail, $hashedSalt)
    {
        $workspaceInvitation = DB::select("select * from todomen_workspace_db.workspace_invitations where SHA1(email_address) = ? ", [$hashedEmail])[0];
        $workspaceInvitation = (array)$workspaceInvitation;
        if ($workspaceInvitation['status_id'] == WorkspaceInvitationStatus::Pending) {
            if ($workspaceInvitation != null && sha1(env('EMAIL_SALT')) == $hashedSalt) {
                try{
                    $workspaceInvitation['status_id'] = WorkspaceInvitationStatus::Accepted;
                    $this->workspaceRepository->updateWorkspaceInvitation($workspaceInvitation['id'], $workspaceInvitation);
                    return redirect(env('ACCEPT_INVITATION_REDIRECT_SUCCESS'));
                }catch (\Exception $e){
                    return redirect(env('ACCEPT_INVITATION_REDIRECT_FAIL'));
                }
            }
            return redirect(env('FRONT_REDIRECT_LOGIN'));
        }else
            return redirect(env('FRONT_REDIRECT_LOGIN'));
    }

    public function getWorkspaceInvitationByStatus($wsInvitationStatusId, $wsId)
    {
        return $this->successResponse($this->workspaceRepository->getWorkspaceInvitationByStatusId($wsInvitationStatusId, $wsId));
    }

    public function getWorkspaceInvitation($id)
    {
        return $this->successResponse($this->workspaceRepository->getWorkspaceInvitation($id));
    }

    public function removeWorkspaceInvitation($id)
    {
        if ($this->workspaceRepository->deleteWorkspaceInvitation($id))
            return $this->successResponse(null, Response::HTTP_NO_CONTENT);
        else
            return $this->errorResponse('Couldn\'t find this resource', Response::HTTP_NOT_FOUND);
    }
}
