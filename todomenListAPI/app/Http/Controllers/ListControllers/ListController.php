<?php


namespace App\Http\Controllers\ListControllers;


use App\Http\Controllers\Controller;
use App\Services\ListService;
use Illuminate\Http\Request;

class ListController extends Controller
{
    protected $listService;

    public function __construct(ListService $listService)
    {
        $this->listService = $listService;
    }

    public function index($boardId)
    {
        return $this->listService->getLists($boardId);
    }

    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required|max:254',
            'board_id'    => 'required',
        ];
        $this->validate($request, $rules);
        return $this->listService->saveList($request->all(), $request->header('Authorization-Key'));
    }

    public function show($list)
    {
        return $this->listService->getList($list);
    }

    public function update(Request $request, $list)
    {
        $rules = [
            'name'      => 'required|max:254',
        ];
        $this->validate($request, $rules);
        return $this->listService->updateList($list, $request->all());
    }

    public function destroy($list)
    {
        return $this->listService->deleteList($list);
    }
}
