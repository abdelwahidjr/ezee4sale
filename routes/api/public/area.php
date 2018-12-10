<?php

Route::group(['prefix' => 'area'] , function ()
{
    Route::get('/all' , 'AreaController@all');

    Route::post('/' , 'AreaController@store');

    Route::get('/{id}' , 'AreaController@show')->where('id' , '[0-9]+');

    Route::post('/update' , 'AreaController@update');

    Route::delete('/{id}' , 'AreaController@destroy')->where('id' , '[0-9]+');

});


