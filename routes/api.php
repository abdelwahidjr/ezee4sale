<?php

Route::prefix('auth')->group(function ()
{

    Route::post('/login' , 'UserAuthController@login');

    Route::post('/signup' , 'UserAuthController@signup');

    Route::get('/signup/activate/{token}' , 'UserAuthController@signupActivate');

    Route::get('/logout' , 'UserAuthController@logout')->middleware('auth:api');

    Route::post('/change-password' , 'UserAuthController@ChangeMyPassword');

    Route::post('/password/email' , 'Auth\ForgotPasswordController@getResetToken');;
    
    Route::post('/password/phone' , 'Auth\ForgotPasswordController@getPhoneResetToken');;

    Route::post('/password/reset' , 'Auth\ResetPasswordController@reset');

    Route::post('/password/reset/by_phone' , 'Auth\ResetPasswordController@resetByPhone');
});

Route::prefix('admin')->middleware('auth:api' , 'role:admin')->group(function ()
{
    foreach (File::allFiles(base_path('routes/api/admin')) as $file)
    {
        require($file->getPathname());
    }
});

Route::prefix('public')->middleware('auth:api')->group(function ()
{
    foreach (File::allFiles(base_path('routes/api/public')) as $file)
    {
        require($file->getPathname());
    }
});

