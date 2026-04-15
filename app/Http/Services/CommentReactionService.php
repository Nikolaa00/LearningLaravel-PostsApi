<?php
namespace App\Http\Services;

use \Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use App\Models\CommentReaction;

class CommentReactionService
{
    public function react(int $commentId, array $data)
    {
        return CommentReaction::updateOrCreate(
            ['comment_id' => $commentId, 'user_id' => $data['user_id']],
            ['emoji' => $data['emoji']]
        );
    }

    public function removeReaction(int $commentId, array $data)
    {
        return CommentReaction::where('comment_id', $commentId)
            ->where('user_id', $data['user_id'])
            ->delete();
    }
    
    public function getReactions(int $commentId)
    {
        return CommentReaction::where('comment_id', $commentId)
            ->with('user')
            ->get();
    }
}