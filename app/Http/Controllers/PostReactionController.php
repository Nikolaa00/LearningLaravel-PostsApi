<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostReaction;
use App\Http\Services\PostReactionService;
use App\Http\Requests\Reaction\StorePostReactionRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class PostReactionController extends Controller
{   
     use AuthorizesRequests;
    private $postReactionService;

    public function __construct(PostReactionService $postReactionService)
    {
        $this->postReactionService = $postReactionService;
    }

    public function react(StorePostReactionRequest $request, int $postId)
    {
        $reaction = $this->postReactionService->react($postId, $request->validated()['emoji'], $request->user());

        return response()->json([
            'message' => 'Reaction added/updated successfully on post',
            'data' => $reaction
        ], 201);
    }

    public function removeReaction(int $postId, Request $request)
    {
        $reaction = PostReaction::where('post_id', $postId)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $this->authorize('delete', $reaction);
        $reaction = $this->postReactionService->removeReaction($postId, $request->user());
        return response()->json([
            'message' => 'Reaction removed successfully from post'
        ], 200);
    }

    public function getReactions(int $postId)
    {
        $reactions = $this->postReactionService->getReactions($postId);

        return response()->json([
            'data' => $reactions
        ], 200);
    }
}
