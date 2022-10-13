<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::apiResource('students', 'api/HouseController');


Route::get('students', 'HouseController@getAllStudents');
Route::get('students/{id}', 'HouseController@getStudent');
Route::post('students', 'HouseController@createStudent');
Route::put('students/{id}', 'HouseController@updateStudent');
Route::delete('students/{id}','HouseController@deleteStudent');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
 return $request->user();
});