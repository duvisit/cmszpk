<?php

return array(
    'lang' => 'hr',
    'development' => true,
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
    'facebook_id' => '',
    'facebook_token' => '',
    'googlemap_token' => '',
    'googlemap_latlng' => ''
);

