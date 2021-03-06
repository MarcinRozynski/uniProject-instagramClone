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


Route::get('/', 'WallController@main');

Auth::routes();

Route::get('/p/create', 'PostsController@create');
Route::post('/p', 'PostsController@store');
Route::get('/p/{post}', 'PostsController@show');
Route::get('/like/{post}','PostsController@getlike');
Route::post('/like/{post}','PostsController@like');
// Route::update('/p/{post}', 'PostsController@updateLikes');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

Route::get('profile/{user}/follow', 'ProfilesController@followUser')->name('user.follow');
Route::get('/{user}/unfollow', 'ProfilesController@unFollowUser')->name('user.unfollow');
Route::get('/followers/{user}', 'ProfilesController@show')->name('user.show');

Route::get('/followings/{user}', 'ProfilesController@showFollowings')->name('user.showFollowings');

Route::post('/comment/store', 'CommentController@store')->name('comment.add');
Route::post('/reply/store', 'CommentController@replyStore')->name('reply.add');

Route::get('/follow-suggestions/{user}', 'FollowSuggestionsController@index');