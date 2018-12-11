<?php

Route::group(['prefix' => 'banner'] , function ()
{

    Route::get('/all','BannerController@all');
    Route::post('/','BannerController@store');


});


