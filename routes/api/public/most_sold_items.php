<?php

Route::group(['prefix' => 'most_sold_items'] , function ()
{

    Route::get('/latest' , 'MostSoldItemsController@getLatest');

});


