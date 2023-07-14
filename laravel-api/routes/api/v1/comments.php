<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

// Route::apiResource('comments', CommentController::class);


Route::group([
    'middleware' => [
        'auth',
    ],
    'prefix' => 'heyaa',
    'name' => 'comments.',
    'namespace' => "\App\Http\Controller",
], function(){
    Route::get('/comments', [CommentController::class, 'index'])->name('index');

    Route::get('/comments/{comment}', [CommentController::class, 'show'])->name('show');

    Route::post('/comments', [CommentController::class, 'store'])->name('store');

    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('update');

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('delete');
});


// Route::middleware('auth')
//     ->prefix('heyaa')
//     ->name('comments.')
//     ->namespace("\App\Http\Controller")
//     ->group(function(){
//     Route::get('/comments', [CommentController::class, 'index'])->name('index');

//     Route::get('/comments/{Comment}', [CommentController::class, 'show'])->name('show');

//     Route::post('/comments', [CommentController::class, 'store'])->name('store');

//     Route::patch('/comments/{Comment}', [CommentController::class, 'update'])->name('update');

//     Route::delete('/comments/{Comment}', [CommentController::class, 'destroy'])->name('delete');
// });
