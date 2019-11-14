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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('user', 'UserController@index')->middleware('auth:api');


Route::put('/logs/{log}', 'LogController@update');

Route::get('/logs/{year}', 'LogController@api_year')->name('logs-year');
Route::get('/logs/{year}/{month}', 'LogController@month')->name('logs-month');

