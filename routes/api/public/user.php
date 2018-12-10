<?php

Route::group(['prefix' => 'user'] , function ()
{

    Route::get('/all' , 'UserController@all');

    Route::post('/' , 'UserController@store');

    Route::get('/{id}' , 'UserController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'UserController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'UserController@destroy')->where('id' , '[0-9]+');

    Route::post('/find-by-mail' , 'UserController@FindByMail');

    Route::post('/change-user-password' , 'UserController@ChangeUserPassword');

    Route::get('/{id}/suggestions-by-friends' , 'UserController@suggestionsByFriends')->where('id' , '[0-9]+');

    Route::get('/{id}/suggestions-by-location' , 'UserController@suggestionsByLocation')->where('id' , '[0-9]+');

    Route::post('/nearby-cafes' , 'UserController@nearbyCafes');

    Route::get('online-users' , 'UserController@getOnlineUsers');

});


