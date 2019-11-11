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
// O-Auth　キー作成
// NULL2:~/environment/ona-nikki $ php artisan passport:install
// Encryption keys generated successfully.
// Personal access client created successfully.
// Client ID: 1
// Client secret: kwFv0PtredHI2hrrhmAHWc7vtzFWuevlNapSeW4O
// Password grant client created successfully.
// Client ID: 2
// Client secret: Ojvz2zIi9W2FfmiSc3bLQwml8Oow4Nl29EvO6h37


// Route::get('/', function () {
//     return view('home');
// });


Route::get('/', 'AppController@index')->name('index');
Route::get('/home', 'AppController@home')->name('home');

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
