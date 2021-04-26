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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('posts', 'PostController', ['only' => ['index','show', 'create', 'store']]); // Route::resource はあまり使わない様にする。

// /posts は Route::group(['prefix' => 'posts', 'as' => 'post.']) で囲む;
Route::get('posts/edit/{id}', 'PostController@edit'); // 各ルーティングに ->name('edit'); など、付ける。
Route::post('posts/edit', 'PostController@update'); // 編集は Route::put() を使う
Route::post('posts/delete/{id}', 'PostController@destroy'); // 削除は Route::delete() を使う
