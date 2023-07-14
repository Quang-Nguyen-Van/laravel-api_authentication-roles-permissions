<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Route::apiResource('posts', PostController::class);


Route::group([
    'middleware' => [
        // 'auth',
    ],
    'prefix' => '',
    'name' => 'posts.',
    'namespace' => "\App\Http\Controller",
], function(){
    Route::get('/posts', [PostController::class, 'index'])->name('index')->withoutMiddleware('auth');

    Route::get('/posts/{post}', [PostController::class, 'show'])->name('show');

    Route::post('/posts', [PostController::class, 'store'])->name('store')->withoutMiddleware('auth');

    Route::patch('/posts/{post}', [PostController::class, 'update'])->name('update');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('delete');

    Route::post('/posts/{post}/share', [PostController::class, 'share'])->name('share');
});


// Route::middleware('auth')
//     ->prefix('heyaa')
//     ->name('posts.')
//     ->namespace("\App\Http\Controller")
//     ->group(function(){
//     Route::get('/posts', [PostController::class, 'index'])->name('index');

//     Route::get('/posts/{Post}', [PostController::class, 'show'])->name('show');

//     Route::post('/posts', [PostController::class, 'store'])->name('store');

//     Route::patch('/posts/{Post}', [PostController::class, 'update'])->name('update');

//     Route::delete('/posts/{Post}', [PostController::class, 'destroy'])->name('delete');
// });
