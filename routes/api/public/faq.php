<?php

Route::group(['prefix' => 'faq'] , function ()
{

    Route::get('/all' , 'FAQController@all');

    Route::post('/' , 'FAQController@store');

    Route::get('/{id}' , 'FAQController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'FAQController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'FAQController@destroy')->where('id' , '[0-9]+');

});


