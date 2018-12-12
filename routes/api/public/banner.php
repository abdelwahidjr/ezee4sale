<?php

Route::group(['prefix' => 'banner'] , function ()
{

    Route::get('/all','BannerController@all');
    Route::get('/home','BannerController@getHomeBanners');
    Route::get('/category/{category_id}','BannerController@getCategoryBanners')->where('category_id' , '[0-9]+');
    Route::post('/','BannerController@store');
    Route::post('/{id}' , 'BannerController@update')->where('id' , '[0-9]+');
    Route::get('/{id}' , 'BannerController@show')->where('id' , '[0-9]+');
    Route::delete('/{id}' , 'BannerController@destroy')->where('id' , '[0-9]+');

});


