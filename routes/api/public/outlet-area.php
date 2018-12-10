<?php

Route::group(['prefix' => 'outlet-area'] , function ()
{
    Route::get('/all' , 'OutletAreaController@all');

    Route::post('/' , 'OutletAreaController@store');

    Route::get('/{id}' , 'OutletAreaController@show')->where('id' , '[0-9]+');

    Route::post('/update' , 'OutletAreaController@update');

    Route::delete('/{id}' , 'OutletAreaController@destroy')->where('id' , '[0-9]+');
});


