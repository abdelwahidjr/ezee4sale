<?php

return [

    'JsonResultCount'       => 10 ,
    'TokenExpireIn'         => 10 ,
    'refreshTokenExpireIn'  => 10 ,
    'fontUrl'               => rtrim(env('FRONT_URL' , 'http://ecovve.test') , '/') ,
    'frontResetPasswordUrl' => rtrim(env('FRONT_URL' . '/password/reset' , 'http://ecovve.test/password/reset') , '/') ,

];