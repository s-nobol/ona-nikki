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

Route::put('/logs/{log}', 'LogController@update');


// home logs
Route::get('/logs/{year}', 'AppController@year')->name('logs-year');
Route::get('/logs/{year}/{month}', 'AppController@month')->name('logs-month');

Route::resource('users', 'UserController');
// Route::resource('logs', 'LogController');

// プロフィールが正しく編集できるようにする
// php artisan make:request UserRequest
// php artisan make:test UserEditTest 