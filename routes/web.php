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

Route::get('/sub', 'CourseHomeController@sub')->name('sub');
Route::get('/unsub', 'CourseHomeController@unsub')->name('unsub');

// Route::get('/user/{name?}', function ($name = 'John') {
// 	return $name;
// });

Route::get('/user', 'UserController@index')->name('user');

Route::get('/course', 'CourseController@index')->name('course');

Route::get('/coursehome/{id}', 'CourseHomeController@index')->name('coursehome');

Route::get('/groupregister/{id}', 'GroupRegisterController@index')->name('groupregister');

Route::get('/grouphome', 'GroupHomeController@index')->name('grouphome');

Route::get('/settings', 'SettingsController@index')->name('settings');

Route::get('/search', 'SearchController@index')->name('search');

Route::get('/secret', 'SecretController@index')->name('secret');
