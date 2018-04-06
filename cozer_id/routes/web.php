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

// USER
Route::post('register', 'ApiController@register');
Route::get('users', 'ApiController@getDataUsers');

// COURSE
Route::post('course', 'ApiController@courseInsert');
Route::post('course/delete/{id}', 'ApiController@courseDeleteId');
Route::get('course', 'ApiController@getDataCourse');
Route::get('course/{id}', 'ApiController@courseId');

// COURSE ENROLL
Route::post('course/{course_id}/enroll/{users_id}', 'ApiController@courseEnrollInsert');
Route::get('course/user/{users_id}', 'ApiController@courseEnrollUsersId');
