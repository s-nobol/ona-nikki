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


// Route::get('/mypage/month/data', 'MypageController@month_data');
// Route::get('/mypage/year/data', 'MypageController@year_data');
// Route::get('/mypage/all/data', 'MypageController@all_data');


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

/***
 * @danger 警告
 * LogController/monthで disint クエリ使用する
 * Mypage_controller/Month strftime('%m-%d') クエリ使用する
 * 
**/

// User::find(103)->delete();

//募金のランキング（後日）
// タイムライン(最後)



// home-vue 修正(内容については問わない、見た目のみ変更する)
// git checkout -b home-vue-revise 
// app.env のCallBack_Url修正