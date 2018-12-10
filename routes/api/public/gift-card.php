<?php

Route::group(['prefix' => 'gift-card'] , function ()
{
    Route::get('/all' , 'GiftCardController@all');

    Route::post('/' , 'GiftCardController@store');

    Route::get('/{id}' , 'GiftCardController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'GiftCardController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'GiftCardController@destroy')->where('id' , '[0-9]+');

});


