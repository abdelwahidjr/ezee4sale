<?php

Route::group(['prefix' => 'country'] , function ()
{
    Route::get('/all' , 'CountryController@all');
    Route::get('/{id}' , 'CountryController@FindById')->where('id' , '[0-9]+');

});


