<?php

Route::group(['prefix' => 'extra'] , function ()
{

    Route::get('/all' , 'ExtraController@all');

    Route::post('/' , 'ExtraController@store');

    Route::get('/{id}' , 'ExtraController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'ExtraController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'ExtraController@destroy')->where('id' , '[0-9]+');

});


