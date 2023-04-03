<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller([UserController::class])->group(function () {
    Route::get('/users', 'index');
    Route::post('/users', 'store');
    Route::get('/users/{id}', 'show');
    Route::patch('/users/{id}', 'update');
    Route::delete('/users/{id}', 'destroy');
});

Route::controller([PostController::class])->group(function () {
    Route::get('/posts', 'index');
    Route::post('/posts', 'store');
    Route::get('/posts/{id}', 'show');
    Route::patch('/posts/{id}', 'update');
    Route::delete('/posts/{id}', 'destroy');
});

Route::controller([CommentController::class])->group(function () {
    Route::get('/comments', 'index');
    Route::post('/comments', 'store');
    Route::get('/comments/{id}', 'show');
    Route::patch('/comments/{id}', 'update');
    Route::delete('/comments/{id}', 'destroy');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
