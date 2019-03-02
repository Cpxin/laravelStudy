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

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/layouts', 'HomeController@index')->name('layouts');

Route::post('staff/wx_staff_login',['uses'=>'StaffController@wx_staff_login']);  //员工登录
Route::post('staff/wx_staff_pwd',['uses'=>'StaffController@wx_staff_pwd']);  //员工密码注册
Route::get('staff/wx_staff_detail',['uses'=>'StaffController@wx_staff_detail']); //微信获取员工详细信息
Route::get('staff/wx_staff_sign',['uses'=>'StaffController@wx_staff_sign']); //员工签到

Route::any('excel/export',['uses'=>'ExcelController@export']);  //excel文件导出
Route::any('excel/import',['uses'=>'ExcelController@import']);  //excel文件导入

Route::any('project/word_save',['uses'=>'ProjectController@word_save']);  //项目内容导入

//Route::get('staff/excel_save',['uses'=>'StaffController@exel_save']);

Route::group(['middleware' => 'auth'], function () {

Route::get('layouts',['uses'=>'StaffController@index']);
Route::get('staff/over',['uses'=>'StaffController@over']);
Route::post('staff/save',['uses'=>'StaffController@save']);
Route::get('staff/detail/{id}',['uses'=>'StaffController@detail']);
Route::post('staff/save_detail/{id}',['uses'=>'StaffController@save_detail']);
Route::post('staff/save_img/{id}',['uses'=>'StaffController@save_img']);
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

Route::get('admin/over',['uses'=>'AdminController@over']);
Route::post('admin/save',['uses'=>'AdminController@save']);
Route::get('admin/delete',['uses'=>'AdminController@delete']);

Route::get('homepage/over',['uses'=>'HomepageController@over']);
Route::get('homepage/article',['uses'=>'HomepageController@article']);
Route::get('homepage/add_title',['uses'=>'HomepageController@add_title']);

});
