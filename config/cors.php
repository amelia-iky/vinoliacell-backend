<?php

return [
    'paths' => ['*'],
    'allowed_methods' => ['GET, POST, PUT, DELETE'],
    'allowed_origins' => ['*'], 
    'allowed_headers' => ['*'], 
    'exposed_headers' => [], 
    'max_age' => 60,
    'supports_credentials' => false,
];
