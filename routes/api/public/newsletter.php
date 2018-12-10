<?php

Route::group(['prefix' => 'newsletter'] , function ()
{
    Route::get('/all' , 'NewsletterController@all');

    Route::post('/' , 'NewsletterController@store');

    Route::get('/{id}' , 'NewsletterController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'NewsletterController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'NewsletterController@destroy')->where('id' , '[0-9]+');

});


