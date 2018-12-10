<?php

Route::group(['prefix' => 'page'] , function ()
{
    Route::get('/all' , 'PageController@all');

    Route::post('/' , 'PageController@store');

    Route::get('/{id}' , 'PageController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'PageController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'PageController@destroy')->where('id' , '[0-9]+');

});


