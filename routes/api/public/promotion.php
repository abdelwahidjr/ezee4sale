<?php

Route::group(['prefix' => 'promotion'] , function ()
{

    Route::get('/all' , 'PromotionController@all');

    Route::post('/' , 'PromotionController@store');

    Route::get('/{id}' , 'PromotionController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'PromotionController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'PromotionController@destroy')->where('id' , '[0-9]+');

});


