<?php
namespace App\Http\Services;

use \Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use App\Models\PostReaction;
class PostReactionService
{
    public function react(int $postId, array $data)
    {
        return PostReaction::updateOrCreate(
            ['post_id' => $postId, 'user_id' => $data['user_id']],
            ['emoji' => $data['emoji']]
        );
    }
    
    public function removeReaction(int $postId, array $data)
    {
        return PostReaction::where('post_id', $postId)
            ->where('user_id', $data['user_id'])
            ->delete();
    }

    public function getReactions(int $postId)
    {
        return PostReaction::where('post_id', $postId)
            ->with('user')
            ->get();
    }
}