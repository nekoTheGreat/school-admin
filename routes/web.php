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

	Route::group(['prefix'=> 'classrooms'], function(){
		
		Route::get('new-form', 'ClassroomController@newForm');

		Route::post('new-form', 'ClassroomController@create');

		Route::get('{classroom_id}', 'ClassroomController@updateForm');

		Route::post('{classroom_id}', 'ClassroomController@update');

		Route::get('{classroom_id}/confirm-delete', 'ClassroomController@deleteForm');

		Route::post('{classroom_id}/confirm-delete', 'ClassroomController@delete');

		Route::get('', 'ClassroomController@index');
	});

	Route::group(['prefix'=> 'students'], function(){
		
		Route::get('new-form', 'StudentController@newForm');

		Route::post('new-form', 'StudentController@create');

		Route::get('{teacher_id}', 'StudentController@updateForm');

		Route::post('{teacher_id}', 'StudentController@update');

		Route::get('{teacher_id}/confirm-delete', 'StudentController@deleteForm');

		Route::post('{teacher_id}/confirm-delete', 'StudentController@delete');

		Route::get('', 'StudentController@index');
	});
});
