<?php

namespace App\Http\Controllers;
use App\Http\Services\PostService;

use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getAll();
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $data = [
            'title' => $request->title,
            'post_content' => $request->post_content,
            'user_id' => $request->user_id,
        ];

        $post = $this->postService->create($data);
        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = $this->postService->getById($id);
        return response()->json($post);
    }
    public function update(Request $request, $id)
    {
        $data = $request->only(['title', 'post_content']);

        $post = $this->postService->update($id, $data);
        return response()->json($post);
    }
    public function destroy($id)
    {
        $this->postService->delete($id);
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}