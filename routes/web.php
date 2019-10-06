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

		Route::post('new-form', 'TeacherController@create');

		Route::get('{teacher_id}', 'TeacherController@updateForm');

		Route::post('{teacher_id}', 'TeacherController@update');

		Route::get('{teacher_id}/confirm-delete', 'TeacherController@deleteForm');

		Route::post('{teacher_id}/confirm-delete', 'TeacherController@delete');

		Route::get('', 'TeacherController@index');
	});
});
