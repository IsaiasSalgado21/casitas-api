<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie','/login', '/logout', '/register','/user'],
    'supports_credentials' => true,

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:8100', 'http://127.0.0.1:8100'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
