<?php

return array(

    'appNameIOS'     => array(
        'environment' =>'development',
        'certificate' => app_path('pushcert_dis.pem'),
        'passPhrase'  =>'netmente@123#',
        'service'     =>'apns'
    ),
    'appNameAndroid' => array(
        'environment' =>'development',
        'apiKey'      =>'AIzaSyARWOOuTmqfn1-oDFwPa5cHWtz7sj4OmLw',
        'service'     =>'gcm'
    )

);