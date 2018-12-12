<?php

Route::group(['prefix' => 'subcategory'] , function ()
{

    Route::post('/','SubCategoryController@store');
    Route::post('/{id}' , 'SubCategoryController@update')->where('id' , '[0-9]+');
    Route::get('/{id}' , 'SubCategoryController@show')->where('id' , '[0-9]+');
    Route::delete('/{id}' , 'SubCategoryController@destroy')->where('id' , '[0-9]+');

});


