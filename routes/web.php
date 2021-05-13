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

Route::group(['prefix' => 'posts', 'as' => 'post.'], function () {
    Route::get('/', 'PostController@index')->name('index');
    Route::post('/', 'PostController@store')->name('store');
    Route::get('/create', 'PostController@create')->name('create');


    Route::group(['prefix' => '{post}'], function () {
        Route::get('/', 'PostController@show')->name('show');
        Route::put('/', 'PostController@update')->name('update');
        Route::delete('/', 'PostController@destroy')->name('destroy');
        Route::get('/edit', 'PostController@edit')->name('edit');
    });
});

Route::group(['prefix' => 'users', 'as' => 'user.'], function () {
    Route::get('/', 'UserController@index')->name('index');

    Route::group(['prefix' => '{user}'], function () {
        Route::get('/', 'UserController@show')->name('show');
        Route::put('/', 'UserController@update')->name('update');
        Route::get('/edit', 'UserController@edit')->name('edit');
    });
});