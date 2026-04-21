<?php

namespace App\Http\Controllers;
use App\Http\Services\PostService;
use Illuminate\Http\Request;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Post;
class PostController extends Controller
{
    use AuthorizesRequests;
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
        $this->authorize('create', Post::class);
        $post = $this->postService->create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
        ]);
        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = $this->postService->getById($id);
        return response()->json($post);
    }
    public function update(UpdatePostRequest $request, $id)
    {
        $post = $this->postService->getById($id);
        $this->authorize('update', $post);
        $post = $this->postService->update($id, $request->validated());
        return response()->json($post);
    }
    public function destroy($id)
    {
        $post = $this->postService->getById($id);
        $this->authorize('delete', $post);

        $this->postService->delete($id);
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}