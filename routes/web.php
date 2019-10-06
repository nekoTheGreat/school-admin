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

Route::get('/', 'HomeController@index');

Route::group(['prefix'=> 'programs'], function(){
	Route::get('', 'ProgramController@index');
});

Route::group(['prefix'=> 'admin'], function(){

	Route::group(['prefix'=> 'teachers'], function(){
		
		Route::get('new-form', 'TeacherController@newForm');

		Route::post('new-form', 'TeacherController@saveForm');

		Route::get('', 'TeacherController@index');
	});
});
