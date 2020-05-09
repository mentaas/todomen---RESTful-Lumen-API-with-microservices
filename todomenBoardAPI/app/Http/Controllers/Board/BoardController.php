<?php


namespace App\Http\Controllers\Board;


use App\Http\Controllers\Controller;
use App\Services\BoardService;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    protected $boardService;

    public function __construct(BoardService $boardService)
    {
        $this->boardService = $boardService;
    }

    public function index($workspaceId)
    {
        return $this->boardService->getBoards($workspaceId);
    }

    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required|max:254',
            'workspace_id'    => 'required',
        ];
        $this->validate($request, $rules);
        return $this->boardService->saveBoard($request->all(), $request->header('Authorization-Key'));
    }

    public function show($board)
    {
        return $this->boardService->getBoard($board);
    }

    public function update(Request $request, $board)
    {
        $rules = [
            'name'      => 'required|max:254',
        ];
        $this->validate($request, $rules);
        return $this->boardService->updateBoard($board, $request->all());
    }

    public function destroy($board)
    {
        return $this->boardService->deleteBoard($board);
    }
}
