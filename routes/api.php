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


Route::put('/logs/{log}', 'LogController@update');

Route::get('/logs/{year}', 'LogController@api_year')->name('logs-year');
Route::get('/logs/{year}/{month}', 'LogController@month')->name('logs-month');

