<?php

Route::group(['prefix' => 'search'] , function ()
{

    Route::post('/user' , 'SearchController@user');

    Route::post('/brand' , 'SearchController@brand');

    Route::post('/city_brand' , 'SearchController@city_brand');

});


