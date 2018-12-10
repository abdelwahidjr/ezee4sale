<?php

Route::group(['prefix' => 'suborder'] , function ()
{

    Route::get('/all' , 'SubOrderController@all');

    Route::get('/{id}' , 'SubOrderController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'SubOrderController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'SubOrderController@destroy')->where('id' , '[0-9]+');

    Route::post('/{id}/add-note' , 'SubOrderController@addNote')->where('id' , '[0-9]+');
});


