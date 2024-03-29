<?php

Route::group(['prefix' => 'user'] , function ()
{

    Route::get('/all' , 'UserController@all');

    Route::post('/' , 'UserController@store');

    Route::get('/{id}' , 'UserController@show')->where('id' , '[0-9]+');

    Route::get('/{id}/notifications' , 'UserController@getUserNotifications')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'UserController@update')->where('id' , '[0-9]+');

    Route::post('/mark_notification_as_read' , 'UserController@markAsRead')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'UserController@destroy')->where('id' , '[0-9]+');


});


