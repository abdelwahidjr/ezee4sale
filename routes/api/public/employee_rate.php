<?php

Route::group(['prefix' => 'employee-rate'] , function ()
{

    Route::get('/all' , 'EmployeeRateController@all');

    Route::post('/' , 'EmployeeRateController@store');

    Route::get('/{id}' , 'EmployeeRateController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'EmployeeRateController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'EmployeeRateController@destroy')->where('id' , '[0-9]+');
    Route::get('/history/{employee_id}' , 'EmployeeRateController@history')->where('id' , '[0-9]+');

});


