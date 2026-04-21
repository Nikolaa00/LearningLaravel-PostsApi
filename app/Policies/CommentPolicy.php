<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->is_admin ?? false) {
            return true;
        }
        return null;
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Comment $comment): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id;
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id;
    }

    public function reply(User $user, Comment $comment): bool
    {
        return $comment->parent_comment_id === null;
    }
}
