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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin ////////////////////////////////////////////////////////////////////////
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('device/datatable/{id}', 'DashboardController@showDataTable')->name('device.datatable');
    Route::get('device/gpstable/{id}', 'DashboardController@showGpsTable')->name('device.gpstable');
    Route::get('device/dashboard/{id}', 'DashboardController@showDashboard')->name('device.dashboard');
    //
    Route::resource('user', 'UserController');
    //
    Route::get('device', 'DeviceController@index')->name('device.index');
    Route::post('device', 'DeviceController@store')->name('device.store');
    Route::put('device/{id}', 'DeviceController@update')->name('device.update');
    Route::delete('device/{id}', 'DeviceController@destroy')->name('device.destroy');
});

// User ////////////////////////////////////////////////////////////////////////
Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User', 'middleware' => ['auth', 'user']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});
