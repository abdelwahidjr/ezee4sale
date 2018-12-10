<?php

Route::group(['prefix' => 'contact_us_message'] , function ()
{
    Route::get('/all' , 'ContactUsMessageController@all');

    Route::post('/' , 'ContactUsMessageController@store');

    Route::get('/{id}' , 'ContactUsMessageController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'ContactUsMessageController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'ContactUsMessageController@destroy')->where('id' , '[0-9]+');

});


