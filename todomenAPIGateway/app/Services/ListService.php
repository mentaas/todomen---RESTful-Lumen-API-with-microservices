<?php


namespace App\Services;


use App\Traits\ConsumeExternalService;

class ListService
{
    use ConsumeExternalService;

    public $baseUri;
    public $secret;
    public $userId;


    public function __construct()
    {
        $this->baseUri = config('services.lists.base_uri');
        $this->secret = config('services.lists.secret');
    }

    //<editor-fold desc="board">

    public function obtainLists($workspaceId)
    {
        return $this->performRequest('GET', "/lists/all/{$workspaceId}");
    }

    public function createList($data)
    {
        return $this->performRequest('POST', '/lists', $data);
    }

    public function obtainList($id)
    {
        return $this->performRequest('GET', "/lists/{$id}");
    }

    public function editList($id, $data)
    {
        return $this->performRequest('PUT', "lists/{$id}", $data);
    }

    public function deleteList($id)
    {
        return $this->performRequest('DELETE', "lists/{$id}");
    }

    //</editor-fold>
}
