<?php


Route::group(['prefix' => 'notification'], function () {
Route::post('/notifiy','PushNotificationController@send');
});