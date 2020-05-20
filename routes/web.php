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

// Route::get('/', function () {
//     return view('front/fronthome');
// });

Route::get('/', 'HomeController@index')->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/user', 'UserDataController@index');

Route::resource('/user','UserDataController');

//Route::put('/user/{id}', 'UserDataController@Update');


Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');


Route::group(['middleware' => ['auth', 'is_admin']], function() {
    // your routes
    Route::resource('userManagement','UserController');
    Route::resource('admin/items','ItemController');
});

