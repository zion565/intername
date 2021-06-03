<?php

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

Route::get('show', 'App\Http\Controllers\MainController@index');
Route::post('store', 'App\Http\Controllers\MainController@store');
Route::get('fetch', 'App\Http\Controllers\MainController@fetch');
Route::get('show/id/{id}', 'App\Http\Controllers\PostController@searchById');
Route::get('show/userId/{user_id}', 'App\Http\Controllers\PostController@searchByUserId');
Route::get('show/content/{string}', 'App\Http\Controllers\PostController@searchByContent');
Route::get('query', 'App\Http\Controllers\MainController@query');


