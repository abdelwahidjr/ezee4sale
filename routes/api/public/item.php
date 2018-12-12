<?php

Route::group(['prefix' => 'item'] , function ()
{

    Route::get('/all' , 'ItemController@all');

    Route::get('/{category}/{sub_category}' , 'ItemController@categoryItems');


    Route::post('/' , 'ItemController@store');

    Route::get('/{id}' , 'ItemController@show')->where('id' , '[0-9]+');

    Route::get('/user_ads/{id}' , 'ItemController@userAds')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'ItemController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'ItemController@destroy')->where('id' , '[0-9]+');


});


