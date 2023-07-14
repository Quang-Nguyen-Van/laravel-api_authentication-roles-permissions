<?php

use App\Helpers\Routes\RouteHelper;
use App\Http\Controllers\AuthController;
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

Route::prefix('v1')
    ->middleware([
        // 'auth:sanctum'
    ])
    ->group(function(){

        RouteHelper::includeRouteFiles(__DIR__ . '/api/v1');

        // // iterate thru the v1 folder recursively
        // $dirIterator = new RecursiveDirectoryIterator(__DIR__ . '/api/v1');

        // /** @var RecursiveDirectoryIterator | RecursiveIteratorIterator $it */
        // $it = new RecursiveIteratorIterator($dirIterator);

        // // require the file in each iteration
        // while($it->valid()){
        //     if(!$it->isDot()
        //         && $it->isFile()
        //         && $it->isReadable()
        //         && $it->current()->getExtension() === 'php')
        //     {
        //         require $it->key();
        //         // require $it->current()->getPathname();
        //     }
        //     $it->next();
        // }

        // require __DIR__ . '/api/v1/users.php';
        // require __DIR__ . '/api/v1/posts.php';
        // require __DIR__ . '/api/v1/comments.php';
    });

    Route::post('/v1/register', [AuthController::class, 'register']);
    Route::post('/v1/login', [AuthController::class, 'login']);
    Route::post('/v1/logout', [AuthController::class, 'logout']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
