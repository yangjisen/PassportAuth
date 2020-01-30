<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Encryption Keys
    |--------------------------------------------------------------------------
    |
    | Passport uses encryption keys while generating secure access tokens for
    | your application. By default, the keys are stored as local files but
    | can be set via environment variables when that is more convenient.
    |
    */

    'passport' => [
        'client_id' => env('passport_client_id', 2),
        'client_secret' => env('passport_client_secret', 'passport_client_secret'),
        'token_expired' => env('passport_token_expired', 30),
        'refresh_expired' => env('passport_refresh_expired', 45)
    ]
];
