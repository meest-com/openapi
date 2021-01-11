<?php

return [
    'base_url' => 'https://api.meest.com/v3.0/openAPI',
    'credential_file' => __DIR__ . '/../../../../../config/credentials/.meest_openapi_token',
    'cache_interval' => 86400,
    'username' => null,
    'password' => null,
    'urls' => require('urls.php')
];
