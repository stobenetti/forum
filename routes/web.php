<?php

use Illuminate\Http\Request;

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

Route::post('/external_login', function (Request $request) {
    $http = new GuzzleHttp\Client;

    try {
        $response = $http->post('http://localhost/bd_api/public/api/login', [
            'form_params' => [
                'email' => $request->email,
                'password' => $request->password,
            ]
        ]);

        $res = json_decode((string)$response->getBody(), true);

        setcookie('access_token', $res['success']['token'], strtotime('+1 year'), '/');
        setcookie('user_id', $res['user']['id'], strtotime('+1 year'), '/');
        setcookie('user_privilege', $res['user']['privilege'], strtotime('+1 year'), '/');
        setcookie('user_name', $res['user']['name'], strtotime('+1 year'), '/');
        setcookie('user_email', $res['user']['email'], strtotime('+1 year'), '/');
        return redirect('/posts');
    } catch (\Exception $exception) {
        return back()->withErrors(['Login e/ou senha inválidos.']);
    }
})->name('external_login');

Route::group(['middleware' => 'App\Http\Middleware\Logged_In'], function () {
//Route::middleware('')->group(function () {

    Route::group(['middleware' => 'App\Http\Middleware\Moderator'], function () {
        Route::resource('replies', 'RepliesController');

        Route::get('/replies/create/{post_id}', 'RepliesController@create')->name('replies.create');

        Route::get('/replies/delete/{id}', 'RepliesController@delete')->name('replies.delete');

        Route::resource('posts', 'PostsController');

        Route::get('/posts/delete/{id}', 'PostsController@delete')->name('posts.delete');
    });

//    Route::resource('posts', 'PostsController');

    Route::get('/posts', 'PostsController@index')->name('posts.index');

    Route::get('/posts/detail/{id}', 'PostsController@show')->name('posts.detail');
//    Route::get('/posts/detail/{id}', 'PostsController@show')->name('posts.detail');

    Route::get('/home', 'PostsController@index')->name('home');

    Route::get('/favorites/', 'FavoritesController@index')->name('favorites.index');

    Route::post('/favorites/verify/', 'FavoritesController@verify')->name('favorites.verify');

//    Route::get('/favorites/store/{post_id}', 'FavoritesController@store')->name('favorites.store');
//    Route::post('/favorites/check', 'FavoritesController@index')->name('favorites.check');

});


Route::get('/sair', 'LogUserOut@index')->name('log_out');