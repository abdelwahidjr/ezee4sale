<?php

Auth::routes();

Route::get('/' , 'HomeController@welcome')->name('welcome');

Route::get('/home' , 'HomeController@home')->name('home');

Route::get('/test' , 'HomeController@test');
