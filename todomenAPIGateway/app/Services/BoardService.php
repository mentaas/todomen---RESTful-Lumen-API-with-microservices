<?php


namespace App\Services;


use App\Traits\ConsumeExternalService;

class BoardService
{
    use ConsumeExternalService;

    public $baseUri;
    public $secret;
    public $userId;


    public function __construct()
    {
        $this->baseUri = config('services.boards.base_uri');
        $this->secret = config('services.boards.secret');
    }

    //<editor-fold desc="board">

    public function obtainBoards($workspaceId)
    {
        return $this->performRequest('GET', "/boards/all/{$workspaceId}");
    }

    public function createBoard($data)
    {
        return $this->performRequest('POST', '/boards', $data);
    }

    public function obtainBoard($id)
    {
        return $this->performRequest('GET', "/boards/{$id}");
    }

    public function editBoard($id, $data)
    {
        return $this->performRequest('PUT', "boards/{$id}", $data);
    }

    public function deleteBoard($id)
    {
        return $this->performRequest('DELETE', "boards/{$id}");
    }

    //</editor-fold>

    //<editor-fold desc="boardUser">

    public function obtainBoardUsers($workspaceId)
    {
        return $this->performRequest('GET', "/boards/users/all/{$workspaceId}");
    }

    public function createBoardUser($data)
    {
        return $this->performRequest('POST', '/boards/users', $data);
    }

    public function obtainBoardUser($id)
    {
        return $this->performRequest('GET', "/boards/users/{$id}");
    }

    public function editBoardUser($id, $data)
    {
        return $this->performRequest('PUT', "boards/users/{$id}", $data);
    }

    public function deleteBoardUser($id)
    {
        return $this->performRequest('DELETE', "boards/users/{$id}");
    }

    //</editor-fold>
}
