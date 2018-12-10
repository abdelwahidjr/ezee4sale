<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN') ,
        'secret' => env('MAILGUN_SECRET') ,
    ] ,

    'ses' => [
        'key'    => env('SES_KEY') ,
        'secret' => env('SES_SECRET') ,
        'region' => env('SES_REGION' , 'us-east-1') ,
    ] ,

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET') ,
    ] ,

    'stripe' => [
        'model'  => App\Models\User::class ,
        'key'    => env('STRIPE_KEY') ,
        'secret' => env('STRIPE_SECRET') ,
    ] ,

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID' , '252500085446324'),         //  facebook Client ID
        'client_secret' => env('FACEBOOK_CLIENT_SECRET' , '35c33223475e7f74e1716da94cbbce02'), //  facebook Client Secret
        'redirect' => 'https://ecovve.com/auth/facebook/callback',
    ],


    'twitter' => [
        'client_id' => env('TWITTER_CLIENT_ID' , 'jUaEK0gqT9vkmnFeoI29NQ0Fs'),         //  twitter Client ID
        'client_secret' => env('TWITTER_CLIENT_SECRET' , 'YSwJhWZoAANATX2xY17h6Ln6iKO17GyyWeQlYFwkr6dcUrcpum'), //  twitter Client Secret
        'redirect' => 'https://ecovve.com/auth/twitter/callback',
    ],

    'google' => [
        'client_id'     => env('GOOGLE_CLIENT_ID' ,'22482460570-2gchbubh815uao78rebtaceasqg5flm7.apps.googleusercontent.com'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET' , '4gFGDlJyQTkwUwQ1qhO0tJtS'),
        'redirect'      => 'https://ecovve.com/auth/google/callback'
    ],
];
