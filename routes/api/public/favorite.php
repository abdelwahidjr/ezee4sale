<?php

Route::group(['prefix' => 'favorite'] , function ()
{
    Route::get('/all' , 'FavoriteController@all');

    Route::post('/' , 'FavoriteController@store');

    Route::get('/{id}' , 'FavoriteController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'FavoriteController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'FavoriteController@destroy')->where('id' , '[0-9]+');


});


