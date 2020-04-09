<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/expiration', function () {
    return view('expiration');
})->name('expiration');

Auth::routes(['reset' => false]);

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin'], function () {
    Route::get('/', 'ManagerController@index')->name('admin.home');
    Route::get('/manager/{manager}', 'ManagerController@view')->name('manager.view');
    Route::resource('employees', 'EmployeeController');
});

Route::group(['middleware' => ['auth', 'role:manager'], 'prefix' => 'manager'], function () {
    Route::get('/', 'ManagerController@show')->name('manager.home');
});
