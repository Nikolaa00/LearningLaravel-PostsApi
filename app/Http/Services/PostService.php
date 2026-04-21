<?php
namespace App\Http\Services;

use App\Models\Post;
use App\Models\User;
use \Illuminate\Database\Eloquent\ModelNotFoundException as EloquentModelNotFoundException;

class PostService
{
    public function getAll()
    {
        return Post::latest()->get();
    }
    public function getById(int $id)// check this 
    {
        return Post::findOrFail($id);
    }
    public function create(array $data)
    {
        return Post::create($data);
    }
    public function update(int $id, array $data)
    {
        $post = $this->getById($id);
        $post->update($data);
        return $post;
    }
    public function delete($id)
    {
        $post = $this->getById($id);
        $post->delete();
    }
}