<?php

Route::group(['prefix' => 'delivery'] , function ()
{

    Route::get('/all' , 'DeliveryOrderController@all');
    Route::get('/history/{deivery_id}' , 'DeliveryOrderController@history');

    Route::post('/' , 'DeliveryOrderController@store');

    Route::get('/{id}' , 'DeliveryOrderController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'DeliveryOrderController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'DeliveryOrderController@destroy')->where('id' , '[0-9]+');


});


