<?php


namespace App\Http\Controllers\Board;


use App\Http\Controllers\Controller;
use App\Services\BoardService;
use Laravel\Lumen\Http\Request;

class BoardUserController extends Controller
{
    protected $boardService;

    public function __construct(BoardService $boardService)
    {
        $this->boardService = $boardService;
    }

    public function index($boardId)
    {
        return $this->boardService->getBoardUsers($boardId);
    }

    public function store(Request $request)
    {
        $rules = [
            'board_id'    => 'required',
            'user_id'    => 'required',
        ];
        $this->validate($request, $rules);
        return $this->boardService->saveBoardUser($request->all(), $request->header('Authorization-Key'));
    }

    public function show($boardUser)
    {
        return $this->boardService->getBoardUser($boardUser);
    }

    public function update(Request $request, $boardUser)
    {
        return $this->boardService->updateBoardUser($boardUser, $request->all());
    }

    public function destroy($boardUser)
    {
        return $this->boardService->deleteBoardUser($boardUser);
    }
}
