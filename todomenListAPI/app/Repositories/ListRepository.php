<?php


namespace App\Repositories;


use App\ListModel;

class ListRepository
{
    protected $list;

    public function __construct(ListModel $listModel)
    {
        $this->list = $listModel;
    }

    public function addList($list)
    {
        return $this->list->create($list);
    }

    public function updateList(int $id, $list)
    {
        $listDb = $this->getListById($id);
        return $listDb->update(['name' => $list['name']]);
    }

    public function deleteList(int $id){
        $list = $this->getListById($id);
        return $list->delete();
    }

    public function getListById(int $id){
        return $this->list->findOrFail($id);
    }

    public function getLists(int $boardId)
    {
        return $this->list->where('board_id', $boardId)->get();
    }
}
