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



// テストの追加
// php artisan make:test Log_CreateTest
// php artisan make:test UserTest
// php artisan make:test Url_Home_Test --unit
// php artisan make:test Url_User_Test --unit
// php artisan make:test Url_Log_Test --unit

// vue で仕上げる
// Vue を使ったシングルアプリケーションに変更
// Oauth認証
// https://qiita.com/hareku/items/ea09602bf40bf0a42040
//1 axios で　Twitterログインページにとぶ
//2 axios /login/Oauth/callback　のvueページを作成する
//3 Twitterログイン後　 /login/Oauth/callback　にアクセスし、パラメータをもとに、Laravelの方に送信する
//4 Store に書き込む