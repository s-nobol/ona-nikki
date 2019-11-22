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



// home logs
Route::get('/log/{year}', 'AppController@year');
Route::get('/log/{year}/{month}', 'AppController@month');
// Route::get('/log/{year}', 'AppController@year');
// Route::get('/log/{year}/{month}', 'AppController@month');

// user logs
// Route::resource('log', 'LogController');
Route::post('/logs', 'LogController@store');
Route::put('/logs/{log}', 'LogController@update');
Route::delete('/logs/{log}', 'LogController@destroy');
Route::get('/mypage/logs/{year}', 'LogController@year');


Route::resource('users', 'UserController');