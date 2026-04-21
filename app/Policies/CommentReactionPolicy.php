<?php

namespace App\Policies;

use App\Models\CommentReaction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentReactionPolicy
{
    public function delete(User $user, CommentReaction $reaction): bool
    {
        return $user->id === $reaction->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }
}
