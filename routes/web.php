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


Route::get('/', 'ATGController@index');

// Route::post('/data_store','ATGController@data_store')->name('data_store') ;

Route::post('/post_user_data_save' , 'WebServicesController@post_user_data_save')->name('post_user_data_save');
