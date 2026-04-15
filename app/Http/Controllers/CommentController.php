<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CommentService;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Requests\ReplyCommentRequest;
class CommentController extends Controller
{
    private $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    public function index()
    {
        $posts = $this->commentService->getAll();
        return response()->json($posts, 200);
    }
    public function store(StoreCommentRequest $request)
    {
        
        $newComment = $this->commentService->create($request->validated());
        return response()->json([
            'message' => 'Comment created successfully',
            'comment' => $newComment
        ], 201);
    }
    public function show(int $id)
    {
        $comment = $this->commentService->getById($id);
        return response()->json($comment, 200);
    }
    public function update(UpdateCommentRequest $request, int $id)
    {
        $this->commentService->update($request->validated(), $id);
        return response()->json([
            'message' => 'Comment updated successfully',
            'content' => $this->commentService->getById($id)
        ], 200);
    }
    public function destroy(int $id)
    {
        $this->commentService->delete($id);
        return response()->json(['message' => 'Comment deleted successfully'], 200);
    }
    public function reply(ReplyCommentRequest $request, int $commentId)
    {
        $reply = $this->commentService->replyToComment($request->validated(), $commentId);
        return response()->json([
            'content' => $reply,
            'message' => 'Reply created successfully'
        ], 201);
    }
}
