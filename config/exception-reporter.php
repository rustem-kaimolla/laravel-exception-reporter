<?php

return [
    'transport' => 'tcp',
    'tcp'       => [
        'host'    => env('EXCEPTION_TCP_HOST', '127.0.0.1'),
        'port'    => env('EXCEPTION_TCP_PORT', 9000),
        'timeout' => 3,
    ],
    'app_name'  => env('APP_NAME', 'laravel-app'),
    'enabled'   => env('EXCEPTION_REPORTER_ENABLED', true),
];
