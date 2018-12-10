<?php

Route::group(['prefix' => 'event'] , function ()
{

    Route::get('/all' , 'EventController@all');

    Route::post('/' , 'EventController@store');

    Route::get('/{id}' , 'EventController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'EventController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'EventController@destroy')->where('id' , '[0-9]+');

});


