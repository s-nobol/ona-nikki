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

Route::get('/', 'AppController@index')->name('index');
Route::get('/home', 'AppController@home')->name('home');


// OAuthでのログイン
// { OAuth } にはgithub twitter google などが入る
Route::get('login/{OAuth}', 'Auth\OAuthController@redirectToProvider')->name('LoginOAuth');
Route::get('login/{OAuth}/callback', 'Auth\OAuthController@handleProviderCallback')->name('LoginOAuthCallback');


// OAuth認証はApiのみ有効
Auth::routes();


// log（おな日記のデータ）の作成
// php artisan make:controller AppController

// マイページ
// ログ
// 月別

Route::get('/ranking', 'AppController@home')->name('ranking');
// Route::get('/search', 'AppController@home')->name('search');
// Route::get('/day', 'AppController@home')->name('home');
Route::get('/information', 'AppController@information')->name('information');


Route::resource('users', 'UserController');
Route::resource('logs', 'LogController');
Route::get('/logs/year/{year}', 'LogController@year')->name('logs-year');
Route::get('/logs/{year}/{month}', 'LogController@month')->name('logs-month');


Route::get('/ranking', 'AppController@ranking');
Route::get('/{year}', 'AppController@year');
Route::get('/{year}/{month}', 'AppController@month');


// Cartjsの導入
// Seed修正

// 2019/1~2020/1で動くが確かめる
// 2019/1/1~2019/2/1で動くが確かめる
// api-test

// vueの作成
// User-vue(profile, years, month )
// All_User-vue(home, years, month )


// Herokuにデプロイ
// Twitterログインページ作成
// パスポートの削除
// composer require laravel/socialite

// Client error: `GET https://api.github.com/user?access_token=` 
// resulted in a `401 Unauthorized` 
// response: { "message": "Requires authentication", 
// "documentation_url": "https://developer.github.com/v3/users/#get-the-authent (truncated...)


// php artisan make:test OAuthTest