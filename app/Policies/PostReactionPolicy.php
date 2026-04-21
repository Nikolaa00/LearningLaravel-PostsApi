<?php

namespace App\Policies;

use App\Models\PostReaction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostReactionPolicy
{
    public function delete(User $user, PostReaction $reaction): bool
    {
        return $user->id === $reaction->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }
}
