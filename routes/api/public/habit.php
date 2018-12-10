<?php

Route::group(['prefix' => 'habit'] , function ()
{

    Route::get('/all' , 'HabitController@all');

    Route::post('/' , 'HabitController@store');

    Route::get('/{id}' , 'HabitController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'HabitController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'HabitController@destroy')->where('id' , '[0-9]+');

});


