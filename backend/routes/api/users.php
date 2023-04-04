<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')
        ->name('index');

    Route::post('/users', 'store')
        ->name('store');

    Route::get('/users/{user}', 'show')
        ->name('show')
        ->whereNumber('user')
        ->where('user', '[0-9]+');

    Route::patch('/users/{user}', 'update')
        ->name('update')
        ->whereNumber('user')
        ->where('user', '[0-9]+');

    Route::delete('/users/{user}', 'destroy')
        ->name('destroy')
        ->whereNumber('user')
        ->where('user', '[0-9]+');
});
