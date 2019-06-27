<?php


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


// Route::get('races', 'RaceController@index');
// Route::post('race', 'RaceController@store');

Route::resource('races', 'RaceController',['except'=>['create','edit']]);
Route::resource('species', 'SpecieController',['except'=>['create','edit']]);
Route::resource('vaccines', 'VaccineController',['except'=>['create','edit']]);
Route::resource('diseases', 'DiseaseController',['except'=>['create','edit']]);
Route::resource('users', 'UserController',['except'=>['create','edit']]);
Route::resource('schedules', 'ScheduleController',['except'=>['create','edit']]);
Route::resource('patients', 'PatientController',['except'=>['create','edit']]);


Route::get('diseasesnp', 'DiseaseController@indexNoPaging');
Route::get('usersadmins', 'UserController@findAdmins');
Route::get('usersnormal', 'UserController@findNormal');
