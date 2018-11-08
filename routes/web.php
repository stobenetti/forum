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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/home', 'PostsController@index')->name('home');

    Route::resource('posts', 'PostsController');

    Route::get('/posts/delete/{id}', 'PostsController@delete')->name('posts.delete');

    Route::resource('replies', 'RepliesController');

    Route::get('/replies/create/{post_id}', 'RepliesController@create')->name('replies.create');

    Route::get('/replies/delete/{id}', 'RepliesController@delete')->name('replies.delete');

    Route::get('/favorites/index/', 'FavoritesController@index')->name('favorites.index');

    Route::post('/favorites/verify/', 'FavoritesController@verify')->name('favorites.verify');

//    Route::get('/favorites/store/{post_id}', 'FavoritesController@store')->name('favorites.store');
//    Route::post('/favorites/check', 'FavoritesController@index')->name('favorites.check');

});


Route::get('/sair', 'LogUserOut@index')->name('log_out');