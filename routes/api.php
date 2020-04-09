<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', 'Auth\LoginController@apiLogin');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/employees',  'ManagerController@show')->middleware('role:manager');
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/managers', 'ManagerController@index');
        Route::get('/manager/{manager}', 'ManagerController@view');
    });
});
