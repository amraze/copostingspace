<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::controller(PostController::class)->group(function () {
    Route::get('/posts', 'index')
        ->name('index');

    Route::post('/posts', 'store')
        ->name('store');

    Route::get('/posts/{post}', 'show')
        ->name('show')
        ->whereNumber('post')
        ->where('post', '[0-9]+');

    Route::patch('/posts/{post}', 'update')
        ->name('update')
        ->whereNumber('post')
        ->where('post', '[0-9]+');

    Route::delete('/posts/{post}', 'destroy')
        ->name('destroy')
        ->whereNumber('post')
        ->where('post', '[0-9]+');
});
