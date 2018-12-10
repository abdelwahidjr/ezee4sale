<?php

Route::group(['prefix' => 'section'] , function ()
{
    Route::get('/all' , 'SectionController@all');

    Route::post('/' , 'SectionController@store');

    Route::get('/{id}' , 'SectionController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'SectionController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'SectionController@destroy')->where('id' , '[0-9]+');


});


