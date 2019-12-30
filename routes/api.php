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

// Heroku修正
// git checkout -b heroku-edit
 	
// ヘロクにアプリデプロイ
// git push heroku master 
 
// マイグレーション 
// heroku run php artisan migrate
// heroku run php artisan migrate:fresh
// heroku run php artisan db:seed
//  heroku config:get APP_KEY

// エラー

// In Connection.php line 669:
                                                                                                                                                                                     
//   SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type date: "11" (SQL: insert into
//   "logs" ("user_id", "month", "day", "time", "category", "coin", "ca  
//   tegory_id", "created_at", "updated_at") values (59, 9, 11, 21, 4, 8, 10, 2018-07-25 00:00:00, 2019-12-30 21:13:34) returning "id")                                                 
                                                                                                                                                                                     

// In Connection.php line 335:
                                                                                                
//   SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type date: "11"  