<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::query()->get();
        return new JsonResponse($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        $created = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if (!$created) {
            return new JsonResponse('Failed to create user');
        }

        return new JsonResponse($created);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        if (!$user) {
            return new JsonResponse('User not found');
        }

        return new JsonResponse($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $updated = $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'password' => $request->password ?? $user->password,
        ]);

        if (!$updated) {
            return new JsonResponse('Failed to update user');
        }

        return new JsonResponse($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        $deleted = $user->forceDelete();

        if (!$deleted) {
            return new JsonResponse('Failed to delete user');
        }

        return new JsonResponse('Deleted user');
    }
}
