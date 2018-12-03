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
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/foo', function(){
	return 'Hello World';
});

// study group membership
Route::get('/grouphome/{id}/join', 'GroupHomeController@join')->name('join');
Route::get('/grouphome/{id}/leave', 'GroupHomeController@leave')->name('leave');
Route::get('/grouphome/{id}/comment', 'GroupHomeController@comment')->name('comment');

// subscriptions
Route::get('/sub/{id}', 'CourseHomeController@sub')->name('sub');
Route::get('/unsub/{id}', 'CourseHomeController@unsub')->name('unsub');

// search page subscription
Route::get('/subList', 'SearchController@subList')->name('subList');

// study group registration
Route::get('/groupregister/{id}/create','GroupRegisterController@create')->name('groupcreate');

Route::get('/user', 'UserController@index')->name('user');

Route::get('/course', 'CourseController@index')->name('course');

Route::get('/coursehome/{id}', 'CourseHomeController@index')->name('coursehome');

Route::get('/groupregister/{id}', 'GroupRegisterController@index')->name('groupregister');

Route::get('/grouphome/{id}', 'GroupHomeController@index')->name('grouphome');

Route::get('/settings', 'SettingsController@index')->name('settings');

Route::get('/search', 'SearchController@index')->name('search');

Route::get('/about', 'AboutController@index')->name('about');

Route::post('/settings', 'UserController@update_avatar');
