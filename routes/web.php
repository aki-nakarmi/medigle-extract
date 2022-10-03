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

Route::post('/closed/import', '\App\Http\Controllers\ClosedFacilityController@import')->name('closed.import');
Route::get('/closed/download', '\App\Http\Controllers\ClosedFacilityController@download')->name('closed.download');
Route::get('/closed/delete', '\App\Http\Controllers\ClosedFacilityController@destroy')->name('closed.destroy');
Route::post('/tel/import', '\App\Http\Controllers\FacilityTelController@import')->name('tel.import');
Route::get('/tel/download', '\App\Http\Controllers\FacilityTelController@download')->name('tel.download');
Route::get('/tel/delete', '\App\Http\Controllers\FacilityTelController@destroy')->name('tel.destroy');
Route::get('/', '\App\Http\Controllers\ClosedFacilityController@index');

