<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'logout', 'dashboard-data'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:3000', 
        'https://vital-up-frontend.vercel.app',
        'https://vital-up-frontend-7s2pn5jp8-youssef-ghailanis-projects.vercel.app',
        'https://vitalupbackend-production.up.railway.app'  // Add this
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,
];
