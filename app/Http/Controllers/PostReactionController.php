<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostReaction;
use App\Http\Services\PostReactionService;
use App\Http\Requests\StorePostReactionRequest;
use App\Http\Requests\RemoveReactionRequest;

class PostReactionController extends Controller
{
    private $postReactionService;
    public function __construct(PostReactionService $postReactionService)
    {
        $this->postReactionService = $postReactionService;
    }
    public function react(StorePostReactionRequest $request, int $postId)
    {
        $reaction = $this->postReactionService->react($postId, $request->validated());

        return response()->json([
            'message' => 'Reaction added/updated successfully on post',
            'data' => $reaction
        ], 201);
    }

    public function removeReaction(int $postId, RemoveReactionRequest $request)
    {
        $this->postReactionService->removeReaction($postId, $request->validated());

        return response()->json([
            'message' => 'Reaction removed successfully from post'
        ], 200);
    }

    public function getReactions(int $postId)
    {
        $reactions = $this->postReactionService->getReactions($postId);

        return response()->json([
            'message' => 'Post reactions fetched successfully',
            'data' => $reactions
        ], 200);
    }
}
