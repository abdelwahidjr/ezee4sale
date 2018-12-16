<?php

Route::group(['prefix' => 'settings'] , function ()
{

    Route::get('/' , 'SettingsController@show');

    Route::post('/' , 'SettingsController@update');


});


