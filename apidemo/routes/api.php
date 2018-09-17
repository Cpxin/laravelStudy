<?php

use App\Article;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

Route::post('register','Auth\RegisterController@register');
Route::post('login','Auth\LoginController@login');
Route::post('logout','Auth\LoginController@logout');
Route::middleware('auth:api')->get('/user',function (Request $request){
   return $request->user();
});
Auth::guard('api')->user();
Auth::guard('api')->check();
Auth::guard('api')->id();

Route::group(['middleware'=>'auth:api'],function (){
    Route::get('articles','ArticleController@index');
    Route::get('articles/{id}','ArticleController@show');
    Route::post('articles','ArticleController@store');
    Route::put('articles/{id}','ArticleController@update');
    Route::delete('articles/{id}','ArticleController@delete');
});

Route::post('auth/register','AuthController@register');

Route::post('auth/login', 'AuthController@login');

Route::group(['middleware' => 'jwt.auth'], function(){
    Route::get('auth/user', 'AuthController@user');
    Route::post('auth/logout','AuthController@logout');
});
Route::group(['middleware' => 'jwt.refresh'], function(){
    Route::get('auth/refresh', 'AuthController@refresh');
});

//Route::get('articles',function (){
//   return Article::all();
//});
//Route::get('articles/{id}',function($id){
//    return Article::find($id);
//});
//Route::post('articles',function (Request $request){
//   return Article::create($request->all);
//});
//Route::put('articles/{id}',function (Request $request,$id){
//    $article=Article::findOrFail($id);
//    $article->update($request->all());
//    return $article;
//});
//Route::delete('articles/{id}',function ($id){
//    Article::find($id)->delete();
//    return 204;
//});

