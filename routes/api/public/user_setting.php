<?php

Route::group(['prefix' => 'user_setting'] , function ()
{

    Route::get('/all' , 'UserSettingController@all');

    Route::post('/' , 'UserSettingController@store');

    Route::get('/{id}' , 'UserSettingController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'UserSettingController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'UserSettingController@destroy')->where('id' , '[0-9]+');

});


