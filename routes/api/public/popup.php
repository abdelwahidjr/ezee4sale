<?php

Route::group(['prefix' => 'popup'] , function ()
{
    Route::get('/all' , 'PopupController@all');
    Route::post('/' , 'PopupController@store');
    Route::get('/{id}' , 'PopupController@show')->where('id' , '[0-9]+');
    Route::post('/{id}' , 'PopupController@update')->where('id' , '[0-9]+');
    Route::delete('/{id}' , 'PopupController@destroy')->where('id' , '[0-9]+');

});


