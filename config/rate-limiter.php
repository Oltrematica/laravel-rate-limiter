<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | API Rate Limiting
    |--------------------------------------------------------------------------
    |
    | Here you may configure the rate limiting settings for your API.
    |
    */
    'api' => [
        /*
         * Ignore admins from rate limiting
         *
         * It requires the User model to have the isAdmin() method
         */
        'ignore_admins' => env('RATE_LIMITING_API_IGNORE_ADMINS', true),
        /*
         * Rate limit for all API requests
         */
        'limit' => env('RATE_LIMITING_API_LIMIT', 60),

    ],
    /*
    |--------------------------------------------------------------------------
    | Rate Limit Login
    |--------------------------------------------------------------------------
    |
    | Here you may configure the rate limiting settings for login requests.
    |
    */
    'login' => [
        'limit_per_minute' => env('RATE_LIMITING_API_LOGIN_LIMIT', 60),
        'limit_per_email' => env('RATE_LIMITING_API_LOGIN_LIMIT_PER_EMAIL', 10),
    ],

    /*
    |--------------------------------------------------------------------------
    | Rate Limit Register
    |--------------------------------------------------------------------------
    |
    | Here you may configure the rate limiting settings for register requests.
    |
    */
    'register' => [
        'limit_per_minute' => env('RATE_LIMITING_API_REGISTER_LIMIT', 60),
    ],

];
