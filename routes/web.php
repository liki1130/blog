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



Route::get('/', 'ArticleController@welcome');

Route::get('/article/{id}', 'ArticleController@article');

Route::get('/user', 'ArticleController@user');

Route::get('/admin', 'ArticleController@admin')->middleware('admin');

Route::group(['middleware' => ['authorityManagement', 'auth']], function () {
    Route::get('/edit/{id}', 'ArticleController@edit');

	Route::post('/update/{id}', 'ArticleController@update');

	Route::post('/delete/{id}', 'ArticleController@delete');

	Route::post('/store', 'ArticleController@store');

	Route::get('/create', 'ArticleController@create');	
});


/*Admin
Route::group(['middleware' => 'authorityManagementAdmin'], function () {
	Route::get('/adminshow', 'ArticleController@adminIndex');

	Route::get('/adminedit/{id}', 'ArticleController@adminEdit');

	Route::get('/usershow', 'ArticleController@usershow');	
});
*/



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


