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
//auth
Route::group(['prefix' => '/auth'], function(){
	//登入
	Route::post('/login', 'AuthController@login');
	//註冊
	Route::post('/register', 'AuthController@register');
	//登出
    Route::post('/logout', 'AuthController@logout')->middleware('refresh.token');
});
//article
Route::group(['prefix' => '/article'], function(){
	//主頁
	Route::get('/index', 'ArticleController@index');
	//文章閱讀
	Route::get('/read/{id}', 'ArticleController@read');

	Route::group(['middleware' => 'refresh.token'], function () {
		//新增文章
		Route::post('/store', 'ArticleController@store');
		//僅能看到登入者自己的文章
		Route::get('/user', 'ArticleController@user');

	    Route::group(['middleware' => 'authority.management'], function () {
	    	//編輯文章頁面資訊
	    	Route::get('/edit/{id}', 'ArticleController@edit');
	   		//更新文章
		    Route::post('/update/{id}', 'ArticleController@update');
		    //刪除文章
		    Route::post('/delete/{id}', 'ArticleController@delete');
	    });
	});
});
//admin
Route::group(['prefix' => '/admin', 'middleware' => ['refresh.token', 'admin']], function(){
	//admin查看使用者清單
	Route::get('/index', 'UserController@index');
});

Route::fallback(function() {
    return response()->json([
        'success' => false,
        'message' => '找不到頁面',
        'data' => '',
    ], 404);
});
