<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::resource('index', 'ArticleController')->only(['index']);
    Route::get('searchArticle', 'ArticleController@search')->name('searchArticle');
    Route::resource('tag', 'TagController')->only(['index','show']);
    Route::get('profile', 'UserController@index')->name('profile');
    Route::get('content', 'ContentController@index')->name('content');
    Route::get('searchContent','ContentController@search')->name('searchContent');
});
