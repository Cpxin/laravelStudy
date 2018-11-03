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
Route::any('staff/delete/{id}',['uses'=>'StaffController@delete']);
Route::post('staff/update',['uses'=>'StaffController@update']);

Route::get('project/over',['uses'=>'ProjectController@over']);
Route::any('project/detail/{id}',['uses'=>'ProjectController@detail']); //项目详情
Route::get('project/add',['uses'=>'ProjectController@add']);
Route::post('project/save',['uses'=>'ProjectController@save']);
Route::get('project/arrange/{id}',['uses'=>'ProjectController@arrange']); //安排人员
//Route::post('project/arrange_search',function (){return csrf_token();},['uses'=>'ProjectController@arrange_search']);
Route::post('project/arrange_search',['uses'=>'ProjectController@arrange_search']);
Route::get('project/start/{id}',['uses'=>'ProjectController@start']);   //项目启动
Route::get('project/assure/{id}',['uses'=>'ProjectController@assure']);  //确认启动
Route::get('project/settle/{id}',['uses'=>'ProjectController@settle']);   //项目结算
Route::post('project/update',['uses'=>'ProjectController@update']);  //项目更新
Route::any('project/delete/{id}',['uses'=>'ProjectController@delete']);

Route::get('record/over',['uses'=>'RecordController@over']);
Route::any('record/delete/{id}',['uses'=>'RecordController@delete']);

Route::get('wages/over',['uses'=>'WagesController@over']);
Route::post('wages/save',['uses'=>'WagesController@save']);
