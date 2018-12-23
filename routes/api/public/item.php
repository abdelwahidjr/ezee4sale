<?php

Route::group(['prefix' => 'item'], function () {

    Route::get('/all', 'ItemController@all');

    Route::get('/category/{category}/sub_category/{sub_category}', 'ItemController@categoryItems');

    Route::get('/ad/category/{category}/sub_category/{sub_category}', 'ItemController@categoryAdItems');

    Route::get('/market/category/{category}/sub_category/{sub_category}', 'ItemController@categoryMarketItems');

    Route::post('/views', 'ItemController@viewed');

    Route::post('/', 'ItemController@store');

    Route::post('/reshare', 'ItemController@reshareItem');

    Route::get('/{id}', 'ItemController@show')->where('id', '[0-9]+');

    Route::get('/user_ads/{id}', 'ItemController@userAds')->where('id', '[0-9]+');

    Route::post('/{id}', 'ItemController@update')->where('id', '[0-9]+');

    Route::delete('/{id}', 'ItemController@destroy')->where('id', '[0-9]+');


});


