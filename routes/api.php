<?php

use Illuminate\Http\Request;


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

Route::get('user_data', 'WebServicesController@get_alluser_data');

Route::get('user_data/{id}' , 'WebServicesController@get_user_data_byid');

Route::post('user_data' , 'WebServicesController@post_user_data_save');

Route::put('user_data/{data}' , 'WebServicesController@put_update_user_data');

Route::delete('user_data/{data}', 'WebServicesController@delete_user_data');

