<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment_content', 'post_id', 'parent_comment_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }
    public function reply()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }
    public function reactions()
    {
        return $this->hasMany(CommentReaction::class);
    }
}
