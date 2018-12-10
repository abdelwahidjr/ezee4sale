<?php

Route::group(['prefix' => 'employee'] , function ()
{

    Route::get('/all' , 'EmployeeController@all');

    Route::post('/' , 'EmployeeController@store');

    Route::get('/{id}' , 'EmployeeController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'EmployeeController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'EmployeeController@destroy')->where('id' , '[0-9]+');

    Route::post('/switch-state' , 'EmployeeController@SwitchState');

});


