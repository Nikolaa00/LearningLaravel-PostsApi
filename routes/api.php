<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentReactionController;
use App\Http\Controllers\PostReactionController;

//Routes for PostController
Route::get('posts', [PostController::class, 'index']);

Route::get('posts/{id}', [PostController::class, 'show']);

Route::post('posts', [PostController::class, 'store']);

Route::put('posts/{id}', [PostController::class, 'update']);

Route::delete('posts/{id}', [PostController::class, 'destroy']);

//Routes for CommentController
Route::get('comments', [CommentController::class, 'index']);

Route::get('comments/{id}', [CommentController::class, 'show']);

Route::post('comments', [CommentController::class, 'store']);

Route::put('comments/{id}', [CommentController::class, 'update']);

Route::delete('comments/{id}', [CommentController::class, 'destroy']);

Route::post('comments/{commentId}/reply', [CommentController::class, 'reply']);

//Routes for CommentReactionController
Route::post('comments/{commentId}/react', [CommentReactionController::class, 'react']);

Route::delete('comments/{commentId}/react', [CommentReactionController::class, 'removeReaction']);

Route::get('comments/{commentId}/reactions', [CommentReactionController::class, 'getReactions']);

//Routes for PostReactionController
Route::post('/posts/{postId}/react', [PostReactionController::class, 'react']);

Route::delete('/posts/{postId}/react', [PostReactionController::class, 'removeReaction']);

Route::get('/posts/{postId}/reactions', [PostReactionController::class, 'getReactions']);

