<?php

Route::group(['prefix' => 'site_setting'] , function ()
{
    Route::get('/all' , 'SiteSettingController@all');

    Route::post('/' , 'SiteSettingController@store');

    Route::get('/{id}' , 'SiteSettingController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'SiteSettingController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'SiteSettingController@destroy')->where('id' , '[0-9]+');

});


