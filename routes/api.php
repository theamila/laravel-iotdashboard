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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/key', function () {
    $var = Str::random(32);

    dd($var);
});

//////////////////////////////////////////////////////////////////////////////////
// Iot data Apis
Route::get('/datasets/airquality', 'Api\IotDataController@index')->name('datasets.airquality');
Route::post('/datasets/iotdata', 'Api\IotDataController@store');
Route::post('/datasets/gps', 'Api\GpsController@store')->middleware('throttle:120,1');
