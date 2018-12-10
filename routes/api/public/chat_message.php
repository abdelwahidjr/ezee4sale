<?php

Route::group(['prefix' => 'chat-message'] , function ()
{

    Route::get('/{id}' , 'ChatMessageController@roomMassages')->where('id' , '[0-9]+');

    Route::post('/' , 'ChatMessageController@store');

});


