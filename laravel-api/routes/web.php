<?php

use App\Events\PlaygroundEvent;
use App\Models\Post;
use App\Models\User;
use Laravel\Fortify\RoutePath;
use Illuminate\Support\Facades\App;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/app', function(){
    return view('app');
});

Route::get(RoutePath::for('password.reset', '/reset-password/{token}'), function ($token){
    return view('auth.password-reset', [
        'token' => $token,
    ]);
})->middleware(['guest:'.config('fortify.guard')])
    ->name('password.reset');


Route::get('/shared/posts/{post}', function (Request $request, Post $post){
    return "Specially made just for you Post id: {$post->id}";

})->name('shared.post')->middleware('signed');

if(App::environment('local')){

    Route::get('/shared/videos/{video}', function (Request $request, $video){
        // if(!$request->hasValidSignature()){
        //     abort(401);
        // }

        return 'git gud';
    })->name('share-video')->middleware('signed');

    Route::get('/playground', function (){
        // $user = User::factory()->make();

        // $repository = new UserRepository();
        // $user = $repository->create([
        //     'name' => 'abc',
        //     'email' => 'abctest@example.com',
        //     'password' => 'abcd1234',
        // ]);

        // $trans = Lang::get('auth.failed');  // These credentials do not match our records.

        // $trans = __('auth.password');  //The provided password is incorrect.

        // $trans = __('auth.throttle', ['seconds' => 5]);  // Too many login attempts. Please try again in 5 seconds.

        // $trans = trans_choice('auth.apples', 2, ['baskets' => 1]); // There are 2 apples in 1 baskets.

        // $trans = __('auth.welcome', ['name' => "nana"]); // HEYOOO Nana NANA nana
        // dd($trans);

        // $user = User::factory()->make();
        // Mail::to($user)->send(new \App\Mail\WelcomeMail($user));

        event(new PlaygroundEvent());
        // $url = URL::temporarySignedRoute('share-video', now()->addSeconds(30), ['video' => 123]);
        // return $url;
        return null;
    });

    Route::get('/ws', function (){
        return view('websocket');
    });
}
