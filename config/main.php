<?php

return [

    'JsonResultCount'       => 10 ,
    'TokenExpireIn'         => 10 ,
    'refreshTokenExpireIn'  => 10 ,
    'fontUrl'               => rtrim(env('FRONT_URL' , 'http://ezee4sale.test') , '/') ,
    'frontResetPasswordUrl' => rtrim(env('FRONT_URL' . '/password/reset' , 'http://ezee4sale.test/password/reset') , '/') ,

];