<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CommentService;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Requests\Comment\ReplyCommentRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Comment;
class CommentController extends Controller
{
    use AuthorizesRequests;
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
        $this->authorize('create', Comment::class);

        $data = $request->validated() + ['user_id' => $request->user()->id];
        $newComment = $this->commentService->create($data);
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
        $comment = $this->commentService->getById($id);
        $this->authorize('update', $comment);

        $updated = $this->commentService->update($request->validated(), $id);

        return response()->json([
            'message' => 'Comment updated successfully',
            'content' => $updated
        ], 200);
    }
    public function destroy(int $id)
    {
        $comment = $this->commentService->getById($id);
        $this->authorize('delete', $comment);
        return response()->json(['message' => 'Comment deleted successfully'], 200);
    }
    public function reply(ReplyCommentRequest $request, int $commentId)
    {
        $parentComment = $this->commentService->getById($commentId);
        $this->authorize('reply', $parentComment);

        $reply = $this->commentService->replyToComment($request->validated(), $commentId, $request->user());
        return response()->json([
            'content' => $reply,
            'message' => 'Reply created successfully'
        ], 201);
    }
}
