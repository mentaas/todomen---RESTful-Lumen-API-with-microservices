<?php


namespace App\Repositories;


use App\Models\Board;
use App\Models\BoardUser;

class BoardRepository
{
    protected $board;
    protected $boardUser;

    public function __construct(Board $board, BoardUser $boardUser)
    {
        $this->board = $board;
        $this->boardUser = $boardUser;
    }

    public function addBoard($board)
    {
        $board = $this->board->create($board);
        $this->addBoardUser(['board_id' => $board['id'], 'user_id' => $board['admin_user_id'], 'created_by_id' => $board['created_by_id']]);
        return $board;
    }

    public function updateBoard(int $id, $board)
    {
        $boardDb = $this->getBoardById($id);
        return $boardDb->update(['name' => $board['name']]);
    }

    public function deleteBoard(int $id){
        $board = $this->getBoardById($id);
        return $board->delete();
    }

    public function getBoardById(int $id){
        return $this->board->findOrFail($id);
    }

    public function getBoards(int $workspaceId)
    {
        return $this->board->where('workspace_id', $workspaceId);
    }

    public function addBoardUser($boardUser)
    {
        return $this->boardUser->create($boardUser);
    }

    public function updateBoardUser(int $id, $boardUser)
    {
        $boardUserDb = $this->getBoardUserById($id);
        return $boardUserDb->update(['name' => $boardUser['name']]);
    }

    public function deleteBoardUser(int $id){
        $boardUser = $this->getBoardUserById($id);
        return $boardUser->delete();
    }

    public function getBoardUserById(int $id)
    {
        return $this->boardUser->findOrFail($id);
    }

    public function getBoardUsers(int $boardId)
    {
        return $this->boardUser->where('board_id', $boardId)->get();
    }

}
