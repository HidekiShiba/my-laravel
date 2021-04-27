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

// Route::get('posts/edit/{id}', 'PostController@edit');
// /posts は Route::group(['prefix' => 'posts', 'as' => 'post.']) で囲む;
// 各ルーティングに ->name('edit'); など、付ける。
// 編集は Route::put() を使う
// 削除は Route::delete() を使う

Route::group(['prefix' => 'posts', 'as' => 'post.'], function () {
    Route::get('/', 'PostController@index')->name('index');
    Route::post('/', 'PostController@store')->name('store');
    Route::get('/create', 'PostController@create')->name('create');
    Route::get('/{id}', 'PostController@show')->name('show');
    Route::get('/edit/{id}', 'PostController@edit')->name('edit');
    Route::put('/{id}', 'PostController@update')->name('update');
    Route::delete('/{id}', 'PostController@destroy')->name('destroy');
});