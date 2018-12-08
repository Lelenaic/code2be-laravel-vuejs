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

Route::apiResource('items', 'ItemController');
Route::apiResource('users', 'UserController');
Route::get('users/{user}/items', 'UserController@listItems');
Route::post('users/{user}/items', 'UserController@addItem');
Route::put('users/{user}/items/{item}', 'UserController@updateItem');
Route::delete('users/{user}/items/{item}', 'UserController@dropItem');