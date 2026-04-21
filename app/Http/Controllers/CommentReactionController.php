<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CommentReactionService;
use App\Http\Requests\Reaction\StoreCommentReactionRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\CommentReaction;
use App\Models\User;

class CommentReactionController extends Controller
{
    use AuthorizesRequests;
    private $commentReactionService;

    public function __construct(CommentReactionService $commentReactionService)
    {
        $this->commentReactionService = $commentReactionService;
    }

    public function react(StoreCommentReactionRequest $request, int $commentId)
    {
        $reaction = $this->commentReactionService->react(
            $commentId,
            $request->validated()['emoji'],
            $request->user()
        );

        return response()->json([
            'message' => 'Reaction added/updated successfully on comment',
            'data' => $reaction
        ], 201);
    }
    public function removeReaction(int $commentId, Request $request)
    {
        $reaction = CommentReaction::where('comment_id', $commentId)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $this->authorize('delete', $reaction);
        $this->commentReactionService->removeReaction($commentId, $request->user());

        return response()->json([
            'message' => 'Reaction removed successfully from comment'
        ], 200);
    }

    public function getReactions(int $commentId)
    {
        $reactions = $this->commentReactionService->getReactions($commentId);

        return response()->json([
            'data' => $reactions
        ], 200);
    }
}
