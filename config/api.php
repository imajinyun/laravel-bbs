<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Interface Rate Limit
    |--------------------------------------------------------------------------
    |
    | Limit interface call frequency.
    |
    */
    'rate_limits' => [

        'access' => [
            'expires' => env('RATE_LIMITS_EXPIRES', 1),
            'limit' => env('RATE_LIMITS', 60),
        ],

        'sign' => [
            'expires' => env('SIGN_RATE_LIMITS_EXPIRES', 1),
            'limit' => env('SIGN_RATE_LIMITS', 30),
        ],

    ],

];
