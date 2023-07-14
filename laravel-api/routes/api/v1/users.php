<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route::apiResource('users', UserController::class);


Route::group([
    'middleware' => [
        // 'auth',
    ],
    // 'prefix' => 'heyaa',
    'name' => 'users.',
    'namespace' => "\App\Http\Controller",
], function(){
    Route::get('/users', [UserController::class, 'index'])
        ->name('index')
        ->withoutMiddleware('auth');

    Route::get('/users/{user}', [UserController::class, 'show'])
        ->name('show')
        // ->where('user', '[0-9]+')
        ->whereNumber('user')
        ->withoutMiddleware('auth');

    Route::post('/users', [UserController::class, 'store'])->name('store');

    Route::patch('/users/{user}', [UserController::class, 'update'])->name('update');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('delete');
});


// Route::middleware('auth')
//     ->prefix('heyaa')
//     ->name('users.')
//     ->namespace("\App\Http\Controller")
//     ->group(function(){
//     Route::get('/users', [UserController::class, 'index'])->name('index');

//     Route::get('/users/{user}', [UserController::class, 'show'])->name('show');

//     Route::post('/users', [UserController::class, 'store'])->name('store');

//     Route::patch('/users/{user}', [UserController::class, 'update'])->name('update');

//     Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('delete');
// });
