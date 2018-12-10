<?php

Route::group(['prefix' => 'attendence'] , function ()
{

    Route::post('/check-in/{employee_id}' , 'AttendenceController@checkIn')->where('employee_id' , '[0-9]+');
    Route::post('/check-out/{employee_id}' , 'AttendenceController@checkOut')->where('employee_id' , '[0-9]+');
    Route::post('/employee-hours' , 'AttendenceController@getEmployeeWorkingHours');
    Route::get('/attendence-report/{month}' , 'AttendenceController@getAllEmployeeWorkingHours')->where('month' , '^(0?[1-9]|1[012])$');


});


