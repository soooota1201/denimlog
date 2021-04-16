<?php

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


Route::group(['prefix' => 'users/{user}', 'as' => 'users.'], function () {
    Route::resource('denims', 'DenimController');
});

Route::group(['prefix' => 'users/{user}/denims/{denim}', 'as' => 'users.denims.'], function () {
    Route::resource('records', 'DenimRecordController');
});