<?php


namespace App\Services;


use App\Repositories\ListRepository;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;

class ListService
{
    use ApiResponser;
    protected $listRepository;

    public function __construct(ListRepository $listRepository)
    {
        $this->listRepository = $listRepository;
    }

    public function saveList($list, int $userId)
    {
        $newList = ['name' => $list['name'], 'board_id' => $list['board_id'], 'created_by_id' => $userId];
        return $this->successResponse($this->listRepository->addList($newList), Response::HTTP_CREATED);
    }

    public function updateList(int $id, $list)
    {
        return $this->successResponse($this->listRepository->updateList($id, $list), Response::HTTP_NO_CONTENT);
    }

    public function deleteList(int $id)
    {
        return $this->successResponse($this->listRepository->deleteList($id), Response::HTTP_NO_CONTENT);
    }

    public function getLists(int $boardId)
    {
        return $this->successResponse($this->listRepository->getLists($boardId));
    }

    public function getList(int $id)
    {
        return $this->successResponse($this->listRepository->getListById($id));
    }
}
