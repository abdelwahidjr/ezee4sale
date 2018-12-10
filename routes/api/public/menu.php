<?php

Route::group(['prefix' => 'menu'] , function ()
{

    Route::get('/all' , 'MenuController@all');

    Route::post('/' , 'MenuController@store');

    Route::get('/{id}' , 'MenuController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'MenuController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'MenuController@destroy')->where('id' , '[0-9]+');

});


