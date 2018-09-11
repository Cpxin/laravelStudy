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

Route::any('bm/index',['uses'=>'BmControllers@index']);
Route::any('bm/index/{pos}',['uses'=>'BmControllers@index']);
Route::any('bm/select',['uses'=>'BmControllers@select']);
//Route::any('bm/select/{need}',['uses'=>'BmControllers@select']);
//Route::any('bm/select/{need}/{id}',['uses'=>'BmControllers@select']);
Route::any('bm/select/{pos}',['uses'=>'BmControllers@select']);
Route::any('bm/add',['uses'=>'BmControllers@add']);
Route::any('bm/save',['uses'=>'BmControllers@save']);
Route::any('bm/detail/{id}',['uses'=>'BmControllers@detail']);
Route::any('bm/update/{id}',['uses'=>'BmControllers@update']);
Route::any('bm/delete/{id}',['uses'=>'BmControllers@delete']);
Route::any('bm/record',['uses'=>'BmControllers@record']);
Route::any('bm/selected',['uses'=>'BmControllers@selected']);

Route::any('bm/project',['uses'=>'ProjectControllers@project']);
Route::any('bm/projectdetail/{id}',['uses'=>'ProjectControllers@detail']);
Route::any('bm/projectadd',['uses'=>'ProjectControllers@add']);
Route::any('bm/projectsave',['uses'=>'ProjectControllers@save']);
Route::any('bm/projectupdate/{id}',['uses'=>'ProjectControllers@update']);
Route::any('bm/projectdelete/{id}',['uses'=>'ProjectControllers@delete']);
Route::any('bm/projectstart/{id}',['uses'=>'ProjectControllers@start']);
Route::any('bm/projectassure/{id}',['uses'=>'ProjectControllers@assure']);

