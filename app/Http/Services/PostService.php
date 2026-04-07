<?php
namespace App\Http\Services;

use App\Models\Post;
use App\Models\User;

class PostService
{
    public function getAll()
    {
        return Post::latest()->get();
    }
    public function getById( int $id)
    {
        return Post::findOrFail($id);
    }
    public function create(array $data)
    {
        return Post::create($data);
    }
    public function update(int $id, array $data){
        $post=Post::findOrFail($id);
        $post->update($data);
        return $post;
    }
    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
    }
}