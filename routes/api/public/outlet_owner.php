<?php

Route::group(['prefix' => 'outlet_owner'] , function ()
{
    Route::get('/all' , 'OutletOwnerController@all');

    Route::post('/' , 'OutletOwnerController@store');

    Route::get('/{id}' , 'OutletOwnerController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'OutletOwnerController@update')->where('id' , '[0-9]+');

    Route::get('/get_assigned_orders/{id}' , 'OutletOwnerController@getAssignedOrders')->where('id' , '[0-9]+');
});


