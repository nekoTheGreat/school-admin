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

Route::group(['prefix'=> 'admin'], function(){
	
	Route::group(['prefix'=> 'education-stages'], function(){
		
		Route::get('new-form', 'EducationStageController@newForm');

		Route::post('new-form', 'EducationStageController@create');

		Route::get('{education_stage_id}', 'EducationStageController@updateForm');

		Route::post('{education_stage_id}', 'EducationStageController@update');

		Route::get('{education_stage_id}/confirm-delete', 'EducationStageController@deleteForm');

		Route::post('{education_stage_id}/confirm-delete', 'EducationStageController@delete');

		Route::get('', 'EducationStageController@index');
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

		Route::group(['prefix'=>'{student_id}'], function(){
			Route::get('confirm-delete', 'StudentController@deleteForm');

			Route::post('confirm-delete', 'StudentController@delete');

			Route::get('subjects', 'StudentController@listSubjects');

			Route::get('', 'StudentController@updateForm');

			Route::post('', 'StudentController@update');
		});

		Route::get('', 'StudentController@index');
	});

	Route::group(['prefix'=> 'subjects'], function(){
		
		Route::get('new-form', 'SubjectController@newForm');

		Route::post('new-form', 'SubjectController@create');

		Route::get('{subject_id}', 'SubjectController@updateForm');

		Route::post('{subject_id}', 'SubjectController@update');

		Route::get('{subject_id}/confirm-delete', 'SubjectController@deleteForm');

		Route::post('{subject_id}/confirm-delete', 'SubjectController@delete');

		Route::get('', 'SubjectController@index');
	});

	Route::group(['prefix'=> 'teachers'], function(){
		
		Route::get('new-form', 'TeacherController@newForm');

		Route::post('new-form', 'TeacherController@create');

		Route::group(['prefix'=>'{teacher_id}'], function(){
			
			Route::get('', 'TeacherController@updateForm');

			Route::post('', 'TeacherController@update');

			Route::get('/confirm-delete', 'TeacherController@deleteForm');

			Route::post('/confirm-delete', 'TeacherController@delete');

			Route::group(['prefix'=> 'subjects'], function(){
				
				Route::get('', 'TeacherController@listSubjects');

				Route::get('/attach', 'TeacherController@attachSubjectsForm');
			});
		});

		Route::get('', 'TeacherController@index');
	});
});
