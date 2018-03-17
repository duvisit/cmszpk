<?php

return array(
    'lang' => 'hr',
    'development' => false,
    'cache' => true,
    'cachelog' => false,
    'database' => array(
        'dsn' => 'sqlite:'.__DIR__.'/database/cmszpk.db',
        'user' => null,
        'pass' => null,
        'options' => array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_CASE => PDO::CASE_LOWER
        ),
    ),
    'facebook_url' => '',
    'facebook_page_id' => '',
    'facebook_app_id' => '',
    'facebook_app_secret' => '',
    'facebook_api_version' => '',
    'googlemap_token' => '',
    'googlemap_latlng' => ''
);
