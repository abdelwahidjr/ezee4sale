<?php

Route::group(['prefix' => 'sms'] , function ()
{
	Route::get('/send/{phone}/{message}' , 'SMSController@send');
	Route::get('/status/{messageId}' , 'SMSController@status');
});