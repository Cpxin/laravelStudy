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

Route::get('layouts',['uses'=>'StaffController@index']);
Route::get('staff/over',['uses'=>'StaffController@over']);
Route::post('staff/save',['uses'=>'StaffController@save']);
Route::get('staff/detail/{id}',['uses'=>'StaffController@detail']);
Route::post('staff/save_detail/{id}',['uses'=>'StaffController@save_detail']);
Route::post('staff/delete/{id}',['uses'=>'StaffController@delete']);
Route::post('staff/update',['uses'=>'StaffController@update']);

Route::get('project/over',['uses'=>'ProjectController@over']);
