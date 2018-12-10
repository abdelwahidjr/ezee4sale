<?php

Route::group(['prefix' => 'review'] , function ()
{
    Route::get('/all' , 'ReviewController@all');

    Route::post('/' , 'ReviewController@store');

    Route::get('/{id}' , 'ReviewController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'ReviewController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'ReviewController@destroy')->where('id' , '[0-9]+');


});


