<?php

Route::group(['prefix' => 'city'] , function ()
{
    Route::get('/all' , 'CityController@all');
    Route::get('/{id}' , 'CityController@FindById')->where('id' , '[0-9]+');

});


