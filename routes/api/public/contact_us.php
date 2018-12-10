<?php

Route::group(['prefix' => 'contact_us'] , function ()
{
    Route::get('/all' , 'ContactUsController@all');

    Route::post('/' , 'ContactUsController@store');

    Route::get('/{id}' , 'ContactUsController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'ContactUsController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'ContactUsController@destroy')->where('id' , '[0-9]+');

});


