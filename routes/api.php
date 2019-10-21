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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=> 'subjects'], function(){

    Route::group(['prefix'=> 'teachers/{teacher_id}'], function(){

        Route::get('', 'API\SubjectController@getTeacher');
    });

    Route::get('', 'API\SubjectController@search');
});
