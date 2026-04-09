<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CommentService;

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
    public function store(Request $request)
    {
        $commentData = [
            'comment_content' => $request->comment_content,
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
        ];
        $newComment = $this->commentService->create($commentData);
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
    public function update(Request $request, $id)
    {
        $this->commentService->update($request->only(['comment_content']), $id);
        return response()->json([
            'message' => 'Comment updated successfully',
            'content' => $this->commentService->getById($id)
        ], 200);
    }
    public function destroy($id)
    {
        $this->commentService->delete($id);
        return response()->json(['message' => 'Comment deleted successfully'], 200);
    }
    public function reply(Request $request, int $commentId)
    {
        $replyData = $request->only(['comment_content', 'user_id']);
        $reply = $this->commentService->replyToComment($replyData, $commentId);
        return response()->json([
            'content' => $reply,
            'message' => 'Reply created successfully'
        ], 201);
    }
}
