<?php

Route::group(['prefix' => 'notification'] , function ()
{
    Route::get('/all' , 'NotificationController@all');

    Route::post('/' , 'NotificationController@store');

    Route::get('/{id}' , 'NotificationController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'NotificationController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'NotificationController@destroy')->where('id' , '[0-9]+');

    Route::post('/seen_action' , 'NotificationController@seen_action');

    Route::get('/user_notifications' , 'NotificationController@user_notifications');




});


