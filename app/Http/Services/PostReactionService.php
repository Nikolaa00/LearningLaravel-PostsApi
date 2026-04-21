<?php
namespace App\Http\Services;

use \Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use App\Models\PostReaction;
use App\Models\User;
class PostReactionService
{
public function react(int $postId, string $emoji, User $user)
{
    return PostReaction::updateOrCreate(
        ['post_id' => $postId, 'user_id' => $user->id],
        ['emoji' => $emoji]
    );
}

    public function removeReaction(int $postId,User $user)
    {
        return PostReaction::where('post_id', $postId)
            ->where('user_id', $user->id)
            ->delete();
    }

    public function getReactions(int $postId)
    {
        return PostReaction::where('post_id', $postId)
            ->with('user')
            ->get();
    }
}