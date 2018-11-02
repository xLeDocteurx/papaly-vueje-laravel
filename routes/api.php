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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/users', 'HomeController@api');

Route::post('boards/store', 'BoardController@store');
Route::post('boards/destroy', 'BoardController@destroy');
Route::post('boards/update', 'BoardController@update');
Route::get('boards/index', 'BoardController@index');

Route::post('categories/get', 'CategoryController@index');
Route::post('categories/store', 'CategoryController@store');
Route::post('categories/destroy', 'CategoryController@destroy');

Route::post('links/index', 'LinkController@index');
Route::post('links/store', 'LinkController@store');
Route::post('links/destroy', 'LinkController@destroy');
