<?php

Route::group(['prefix' => 'item'] , function ()
{

    Route::get('/all' , 'ItemController@all');

    Route::post('/' , 'ItemController@store');

    Route::get('/{id}' , 'ItemController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'ItemController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'ItemController@destroy')->where('id' , '[0-9]+');

    Route::get('/most-purchases/{brand_id}' , 'ItemController@mostPurchased')->where('brand_id' , '[0-9]+');

});


