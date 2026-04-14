<?php

namespace App\Http\Controllers;
use App\Http\Services\PostService;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

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

    public function store(StorePostRequest $request)
    {
        $post = $this->postService->create($request->validated());
        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = $this->postService->getById($id);
        return response()->json($post);
    }
    public function update(UpdatePostRequest $request, $id)
    {
        $post = $this->postService->update($id, $request->validated());
        return response()->json($post);
    }
    public function destroy($id)
    {
        $this->postService->delete($id);
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}