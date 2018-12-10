<?php

Route::group(['prefix' => 'chef'] , function ()
{

    Route::get('/all' , 'ChefOrderController@all');
    Route::get('/history/{chef_id}' , 'ChefOrderController@history');

    Route::post('/' , 'ChefOrderController@store');

    Route::get('/{id}' , 'ChefOrderController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'ChefOrderController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'ChefOrderController@destroy')->where('id' , '[0-9]+');


});


