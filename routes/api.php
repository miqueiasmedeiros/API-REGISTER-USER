<?php

// Route::apiResource('students', 'api/HouseController');


Route::get('students', 'HouseController@getAllStudents');
Route::get('students/{id}', 'HouseController@getStudent');
Route::post('students', 'HouseController@createStudent');
Route::put('students/{id}', 'HouseController@updateStudent');
Route::delete('students/{id}','HouseController@deleteStudent');
