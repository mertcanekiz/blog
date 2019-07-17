<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\TextPost;

Route::middleware('throttle:100,1')->group(function(){
    Route::get('/', function () {
        if (Auth::user()) {
            return view('home', ['posts' => TextPost::orderBy('created_at', 'desc')->get()]);
        }
        return view('welcome');
    })->name('home');
});

Auth::routes();

// Profile routes
Route::middleware('auth', 'throttle:100,1')->group(function () {
    Route::get('/test', 'ProfileController@show');
    Route::group(['prefix' => 'profile'], function()
    {
        Route::group(['middleware' => 'auth'], function()
        {
            Route::get('edit/', 'ProfileController@edit')->name('editProfile');
            Route::post('edit/', 'ProfileController@update')->name('updateProfile');
            // Show user's own profile without username
            Route::get('/', 'ProfileController@show')->name('profile');
        });
        // Show profile with username (no auth needed)
        Route::get('{username}', 'ProfileController@show')->name('profileWithUsername');
    });

    Route::resource(
        'posts', 'PostController')->only([
        'create', 'store' , 'destroy'
    ]);

    Route::post('/posts/{id}/comment', 'PostController@comment')->name('comment');
    Route::post('/posts/{id}/deleteComment', 'PostController@deleteComment')->name('deleteComment');
    Route::resource(
        'imageposts', 'imagePostController')->only([
        'create', 'store'
    ]);

});

Route::get('/posts/{id}/like', ['uses' => 'PostController@like'])->name('likePost');