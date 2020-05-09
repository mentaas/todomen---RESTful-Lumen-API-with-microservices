<?php


namespace App\Services;


use App\Repositories\BoardRepository;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;

class BoardService
{
    protected $boardRepository;
    use ApiResponser;

    public function __construct(BoardRepository $boardRepository)
    {
        $this->boardRepository = $boardRepository;
        set_exception_handler(array('App\Services\BoardService','exception_handler'));
    }

    public static function exception_handler(\Exception $e) {
        return \response()->json(['error' => $e->getMessage(), 'code' => Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);
    }

    public function saveBoard($board, $userId)
    {
        $newBoard = ['name' => $board['name'], 'workspace_id' => $board['workspace_id'], 'admin_user_id' => $userId, 'created_by_id' => $userId];
        return $this->successResponse($this->boardRepository->addBoard($newBoard), Response::HTTP_CREATED);
    }

    public function updateBoard(int $id, $board)
    {
        return $this->successResponse($this->boardRepository->updateBoard($id, $board), Response::HTTP_NO_CONTENT);
    }

    public function getBoard(int $id)
    {
        return $this->successResponse($this->boardRepository->getBoardById($id));
    }

    public function getBoards(int $workspaceId){
        return $this->successResponse($this->boardRepository->getBoards($workspaceId)->get());
    }

    public function deleteBoard(int $id)
    {
        return $this->successResponse($this->boardRepository->deleteBoard($id), Response::HTTP_NO_CONTENT);
    }

    //BoardUser
    public function saveBoardUser($boardUser, int $userId)
    {
        $newBoardUser = ['board_id' => $boardUser['board_id'], 'user_id' => $boardUser['user_id'], 'created_by_id' => $userId];
        return $this->successResponse($this->boardRepository->addBoardUser($newBoardUser), Response::HTTP_CREATED);
    }

    public function updateBoardUser(int $id, $boardUser)
    {
        return $this->successResponse($this->boardRepository->updateBoardUser($id, $boardUser), Response::HTTP_NO_CONTENT);
    }

    public function deleteBoardUser(int $id)
    {
        return $this->successResponse($this->boardRepository->deleteBoardUser($id));
    }

    public function getBoardUser(int $id)
    {
        return $this->successResponse($this->boardRepository->getBoardUserById($id));
    }

    public function getBoardUsers(int $boardId)
    {
        return $this->successResponse($this->boardRepository->getBoardUsers($boardId));
    }

}
