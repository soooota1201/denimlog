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

Route::get('/', function() {
  return view('welcome');
});

Route::get('/users', function() {
  if(!Auth::user()) {
    return redirect('login');
  }
  return redirect()->route('home.index', Auth::id());
});

Route::resource('users', 'UserController')->only('show', 'edit', 'update');

Route::group(['prefix' => 'users/{user}', 'as' => 'users.'], function() {
    Route::resource('denims', 'DenimController');
    Route::get('follow', 'FollowController@store')->name('follow');
    Route::get('unfollow', 'FollowController@destroy')->name('unfollow');
    Route::get('hasfollow', 'FollowController@hasFollow')->name('hasfollow');

    Route::group(['prefix' => 'denims/{denim}'], function () {
      Route::resource('records', 'DenimRecordController');

      Route::group(['prefix' => 'records/{record}'], function () {
        Route::get('like', 'LikeController@store')->name('like');
        Route::get('unlike', 'LikeController@destroy')->name('unlike');
        Route::get('count', 'LikeController@count')->name('count');
        Route::get('haslikes', 'LikeController@hasLike')->name('haslikes');
        Route::post('comments/{comment}', 'CommentController@store')->name('comments.store');
        Route::delete('comments/{comment}', 'CommentController@destroy')->name('comments.destroy');
      });
    });

    Route::get('home', 'FollowController@followList')->name('home.index');

    Route::get('following', 'FollowListController@followingUserIndex')->name('following.user.index');
    Route::get('followed', 'FollowListController@followedUserIndex')->name('followed.user.index');
    
    Route::get('search', 'SearchController@index')->name('search');
    Route::get('search/records', 'SearchController@searchRecord')->name('search.records');
});

// Route::get('/reply/like/{record}', 'RepliesController@like')->name('reply.like');
// Route::get('/reply/unlike/{record}', 'RepliesController@unlike')->name('reply.unlike');