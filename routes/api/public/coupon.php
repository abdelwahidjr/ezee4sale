<?php

Route::group(['prefix' => 'coupon'] , function ()
{

    Route::get('/all' , 'CouponController@all');

    Route::get('/byType/{type}' , 'CouponController@couponsByType');

    Route::post('/' , 'CouponController@store');

    Route::get('/{id}' , 'CouponController@show')->where('id' , '[0-9]+');

    Route::post('/{id}' , 'CouponController@update')->where('id' , '[0-9]+');

    Route::delete('/{id}' , 'CouponController@destroy')->where('id' , '[0-9]+');

});


