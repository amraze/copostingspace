<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::controller(CommentController::class)->group(function () {
    Route::get('/comments', 'index')
        ->name('index');

    Route::post('/comments', 'store')
        ->name('store');

    Route::get('/comments/{comment}', 'show')
        ->name('show')
        ->whereNumber('comment')
        ->where('comment', '[0-9]+');

    Route::patch('/comments/{comment}', 'update')
        ->name('update')
        ->whereNumber('comment')
        ->where('comment', '[0-9]+');

    Route::delete('/comments/{comment}', 'destroy')
        ->name('destroy')
        ->whereNumber('comment')
        ->where('comment', '[0-9]+');
});
