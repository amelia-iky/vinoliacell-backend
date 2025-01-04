<?php

return [
    'paths' => ['*'],
    'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE'],
    'allowed_origins' => ['http://localhost:5173'],
    'allowed_headers' => ['Content-Type, Authorization'],
    'exposed_headers' => [],
    'max_age' => 86400,
    'supports_credentials' => false,
];
