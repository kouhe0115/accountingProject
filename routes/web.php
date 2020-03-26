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

Auth::routes();

// ユーザーのログイン中の処理
Route::group(['middleware' => 'auth:user'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

// 店舗ユーザーのログイン中の処理
Route::group(['prefix' => 'shop', 'middleware' => 'auth:shop'], function () {
    Route::post('logout', 'Shop\Auth\LoginController@logout')->name('shop.logout');
    Route::get('home', 'Shop\HomeController@index')->name('shop.home');
});

// 店舗ユーザーの未ログイン中の処理
Route::group(['prefix' => 'shop'], function () {
    Route::get('/', function () {
        return redirect('/Shop/home');
    });
    Route::get('login', 'Shop\Auth\LoginController@showLoginForm')->name('shop.login');
    Route::post('login', 'Shop\Auth\LoginController@login');
    Route::get('register', 'Shop\Auth\RegisterController@showRegistrationForm')->name('shop.register');
    Route::post('register', 'Shop\Auth\RegisterController@register');
});


