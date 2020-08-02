<?php

use Illuminate\Support\Facades\Route;

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
// Route::redirect('/', '/home');
Route::get('/', function() {
	return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/logout', 'UserController@logout')->name('logout')->middleware('auth');

Route::get('/profile', 'UserController@getProfile')->name('getProfile')->middleware('auth');
Route::post('/chandeDP', 'UserController@update_avatar')->name('updateDP')->middleware('auth');

Route::post('/uploadPost', 'PostController@store')->name('getPost')->middleware('auth');
Route::get('/posts/{posts}', 'PostController@index')->name('viewPost')->middleware('auth');
Route::get('/delete/{post_id}', 'PostController@destroy')->name('deletePost')->middleware('auth');

Route::post('/like', 'PostController@postLikePost')->name('likePost')->middleware('auth');
