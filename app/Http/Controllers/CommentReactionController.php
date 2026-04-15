<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentReaction;
use App\Http\Services\CommentReactionService;
use App\Http\Requests\StoreCommentReactionRequest;
use App\Http\Requests\RemoveReactionRequest;

class CommentReactionController extends Controller
{
    private $commentReactionService;

    public function __construct(CommentReactionService $commentReactionService)
    {
        $this->commentReactionService = $commentReactionService;
    }

    public function react(StoreCommentReactionRequest $request, int $commentId)
    {
        $reaction = $this->commentReactionService->react($commentId, $request->validated());

        return response()->json([
            'message' => 'Reaction added/updated successfully on comment',
            'data' => $reaction
        ], 201);
    }

    public function removeReaction(int $commentId, RemoveReactionRequest $request)
    {
        $this->commentReactionService->removeReaction($commentId, $request->validated());

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
