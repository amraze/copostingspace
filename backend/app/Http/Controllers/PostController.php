<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Exception;
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

            if ($userIds = $request->user_ids) {
                $created->users()->sync($userIds);
            }

            return $created;
        });

        if (!$created) {
            throw new Exception('Failed to create post');
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
            throw new Exception('Post not found');
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

        $updated = DB::transaction(function () use ($request, $post) {

            $updated = $post->update([
                'title' => $request->title ?? $post->title,
                'body'  => $request->body ?? $post->body,
            ]);

            if ($userIds = $request->user_ids) {
                $post->users()->sync($userIds);
            }

            return $updated;
        });


        if (!$updated) {
            throw new Exception('Failed to update post');
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
            throw new Exception('Failed to delete post');
        }

        return new JsonResponse('Deleted post');
    }
}
