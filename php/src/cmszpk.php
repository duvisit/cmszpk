<?php

return array(
    'lang' => 'hr',
    'timezone' => 'UTC',
    'development' => false,
    'purifyhtml' => false,
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
    'mediadirs' => array(
        'media', 'upload'
    ),
    'uploaddir' => 'upload',
    'facebook_id' => '',
    'facebook_token' => '',
    'facebook_url' => 'https://www.facebook.com',
    'googlemap_token' => '',
    'googlemap_latlng' => ''
);

