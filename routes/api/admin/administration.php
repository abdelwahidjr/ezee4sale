<?php

Route::group(['prefix' => 'administration'] , function ()
{

    Route::get('/show_commission' , 'AdministrationController@show_commission');

    Route::post('/update_commission' , 'AdministrationController@update_commission');

    Route::get('/cafe_count' , 'AdministrationController@cafe_count');

    Route::get('/order_count' , 'AdministrationController@order_count');

    Route::post('/orders-report' , 'AdministrationController@OrdersReport');

    Route::post('/category-products-report' , 'AdministrationController@CategoryProductsReport');

    Route::post('/gift-cards-report' , 'AdministrationController@GiftCardsReport');

    Route::post('/send_coupons' , 'AdministrationController@SendCoupons');


});


