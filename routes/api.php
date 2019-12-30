<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Auth::routes();
Route::get('/currentUser', function () {
    return Auth::user();
});
// トークンリフレッシュ
Route::get('/reflesh-tiken', function(Request $request){
    $request->session()->regenerateToken();
    return response()->json();
});

// Oauth
Route::get('/login/{OAuth}', 'Auth\OAuthController@redirectToProvider');
Route::get('/login/{OAuth}/callback', 'Auth\OAuthController@handleProviderCallback');


// 後日変更を検討する？
// Route::get('/app/logs/{year}', 'AppController@year');
// Route::get('/app/logs/{year}/{month}', 'AppController@month');

// home 
Route::get('/home', 'AppController@home');
Route::get('/notify', 'AppController@notify');
Route::get('/sex', 'AppController@sex');
Route::get('/locations', 'AppController@locations');
Route::get('/location/{name}', 'AppController@location');
Route::get('/ranking/{name}', 'AppController@ranking');
Route::get('/home/logs/{year}', 'LogController@year');
Route::get('/home/logs/{year}/{month}', 'LogController@month');


// milage ログイン後のユーザーページ
Route::get('/mypage', 'MypageController@mypage');
Route::get('/mypage/logs/{year}', 'MypageController@year');
Route::get('/mypage/logs', 'MypageController@logs');
Route::get('/mypage/quest', 'MypageController@quest');


Route::get('/mypage/month/data', 'MypageController@month_data');
Route::get('/mypage/year/data', 'MypageController@year_data');
Route::get('/mypage/all/data', 'MypageController@all_data');


// user logs ( 作成 / 編集 / 削除 のみ)
Route::resource('logs', 'LogController');
Route::resource('users', 'UserController');
Route::resource('notifies', 'NotifyController');
Route::resource('categories', 'CategoryController');

Route::put('/users/{user}/status_update', 'UserController@status_update');
Route::post('/users/{user}/resetlevel', 'UserController@resetlevel');

// 募金
Route::put('/logs/{log}/donation', 'LogController@donation');
Route::get('/users/logs/donation', 'UserController@donation');

// フォロー
Route::post('/follow/{user}', 'FollowController@store');
Route::delete('/follow/{user}', 'FollowController@destroy');

/***
 * @danger 警告
 * LogController/monthで disint クエリ使用する
 * Mypage_controller/Month strftime('%m-%d') クエリ使用する
 * 
**/



// php artisan db:seed
// php artisan migrate:fresh

// ヘロクにアプリデプロイ
// git push heroku master 

//タイムラインの作成
// git checkout -b twitterfeed
//  npm install vue-tweet-embed --save-dev
//  source <(curl -sL https://cdn.learnenough.com/heroku_install)

// データベース作成
// heroku config:set DB_CONNECTION=pgsql
// heroku config:set DB_HOST=ec2-107-21-110-75.compute-1.amazonaws.com
// heroku config:set DB_DATABASE=test
// heroku config:set DB_USERNAME=
// heroku config:set DB_PASSWORD=
 
 	
 
// マイグレーション 
// heroku config:set APP_KEY=$(php artisan --no-ansi key:generate --show)
// heroku run php artisan migrate
// heroku run php artisan migrate:fresh
// heroku run php artisan db:seed
//  heroku config:get APP_KEY