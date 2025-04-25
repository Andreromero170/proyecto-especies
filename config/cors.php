<?php

return [
    'defaults' => [
        'supports_credentials' => false,
        'allowed_origins' => ['http://localhost:5173'], 
        'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization'],
        'allowed_methods' => ['*'],
        'exposed_headers' => [],
        'max_age' => 0,
    ],
];
