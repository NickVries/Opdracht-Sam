<?php

return [
    'database'  => [
        'name'       => 'OpdrachtSam',
        'username'   => 'root',
        'password'   => '',
        'connection' => 'mysql:host=127.0.0.1',
        'options'    => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ],
    ],
    'providers' => [
        \App\Providers\AppServiceProvider::class,
    ],
];
