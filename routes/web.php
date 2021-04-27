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

Auth::routes();

Route::get('/users', function() {
  if(! Auth::user()) {
    return redirect('login');
  }
  return redirect()->route('users.show', Auth::id());
});

Route::resource('users', 'UserController')->only('show', 'edit', 'update');

Route::group(['prefix' => 'users/{user}', 'as' => 'users.'], function() {
    Route::resource('denims', 'DenimController');

    Route::group(['prefix' => 'denims/{denim}'], function () {
    Route::resource('records', 'DenimRecordController');
  });
});

Route::get('/search/records', 'SearchController@searchRecord');
Route::get('/search/denims', 'SearchController@searchDenim');