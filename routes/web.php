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

Route::get('/', function () {
    if (Auth::user()) {
        return view('home');
    }
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('profile/', [
    'middleware' => 'auth',
    'uses' => 'ProfileController@show'
])->name('profile');


Route::get('/profile/edit', 'ProfileController@edit');
Route::post('/profile/edit', [
    'uses' => 'ProfileController@update'
])->name('editProfile');
Route::get('/profile/{username}', 'ProfileController@show')->name('profileWithUsername');
