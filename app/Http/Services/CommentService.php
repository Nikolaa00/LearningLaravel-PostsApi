<?php
namespace App\Http\Services;

use App\Models\Comment;
use \Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
class CommentService
{
    public function getAll()
    {
        $comments = Comment::all();
        return $comments;
    }

    public function getById(int $id)
    {
        try {
            $comment = Comment::findOrFail($id);
            return $comment;
        } catch (ModelNotFoundException $e) {
            abort(404, 'Comment not found');
        }
    }
    public function create(array $data)
    {
        return Comment::create($data);
    }
    public function update(array $data, int $id)
    {
        $comment = $this->getById($id);
        $comment->update($data);
        return $comment;
    }
    public function delete(int $id): void
    {
        $comment = $this->getById($id);
        $comment->delete();
    }
    public function replyToComment(array $data, int $commentId)
    {
        $parentComment = $this->getById($commentId);

        if ($parentComment->parent_comment_id !== null) {
            abort(400, 'You can only reply to main comments');
        }

        return Comment::create([
            'post_id' => $parentComment->post_id,
            'user_id' => $data['user_id'],
            'parent_comment_id' => $parentComment->id,
            'comment_content' => $data['comment_content'],
        ]);

    }
}