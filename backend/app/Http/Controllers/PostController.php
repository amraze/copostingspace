<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = Post::query()->paginate(20);
        return new JsonResponse($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePostRequest $request)
    {
        $created = DB::transaction(function () use ($request) {
            $created = Post::query()->create([
                'title' => $request->title,
                'body'  => $request->body,
            ]);

            $created->users()->sync($request->user_ids);

            return $created;
        });

        if (!$created) {
            return new JsonResponse('Failed to create post');
        }

        return new JsonResponse($created);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Post $post)
    {
        if (!$post) {
            return new JsonResponse('Post not found');
        }

        return new JsonResponse($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $updated = $post->update([
            'title' => $request->title ?? $post->title,
            'body'  => $request->body ?? $post->body,
        ]);

        if (!$updated) {
            return new JsonResponse('Failed to update post');
        }

        return new JsonResponse($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {
        $deleted = $post->forceDelete();

        if (!$deleted) {
            return new JsonResponse('Failed to delete post');
        }

        return new JsonResponse('Deleted post');
    }
}
