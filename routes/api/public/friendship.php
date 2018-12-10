<?php

Route::group(['prefix' => 'friendship'] , function ()
{

    Route::get('/all' , 'FriendshipController@all');

    Route::post('/' , 'FriendshipController@store');

    Route::get('/{id}' , 'FriendshipController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'FriendshipController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'FriendshipController@destroy')->where('id' , '[0-9]+');

    Route::get('/show_user_friends/{id}' , 'FriendshipController@show_user_friends')->where('id' , '[0-9]+');

    Route::get('/unfriend/{id}' , 'FriendshipController@unfriend')->where('id' , '[0-9]+');





});


