<?php

Route::group(['prefix' => 'administration'] , function ()
{

    Route::post('/send_users_notifications' , 'AdministrationController@SendNotifications');


});


