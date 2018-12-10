<?php

Route::group(['prefix' => 'chat-room'] , function ()
{

    Route::get('/all' , 'ChatRoomController@all');

    Route::post('/' , 'ChatRoomController@store');

    Route::post('/add_users' , 'ChatRoomController@add_users_to_chat');

    Route::get('/{id}' , 'ChatRoomController@show')->where('id' , '[0-9]+');


});


