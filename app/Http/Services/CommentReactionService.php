<?php
namespace App\Http\Services;

use App\Models\User;
use \Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use App\Models\CommentReaction;

class CommentReactionService
{
    public function react(int $commentId, string $emoji,User $user)
    {
        return CommentReaction::updateOrCreate(
            ['comment_id' => $commentId, 'user_id' => $user->id],
            ['emoji' => $emoji]
        );
    }

    public function removeReaction(int $commentId,User $user)
    {
        return CommentReaction::where('comment_id', $commentId)
            ->where('user_id', $user->id)
            ->delete();
    }

    public function getReactions(int $commentId)
    {
        return CommentReaction::where('comment_id', $commentId)
            ->with('user')
            ->get();
    }
}