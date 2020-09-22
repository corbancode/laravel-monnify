<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Monnify Contract Code
    |--------------------------------------------------------------------------
    |
    | See your Monnify dashboard to get your contract code.
    |
    */

    'contract_code' => env('MONNIFY_CONTRACT_CODE', ''),

    /*
    |--------------------------------------------------------------------------
    | Monnify Secret Key
    |--------------------------------------------------------------------------
    |
    | To access some endpoints such as the Reserved Account APIs,
    | you first need to get an access token by authenticating with secret key
    | and api key. See your Monnify dashboard to get your secret key.
    |
    */
    'secret_key' => env('MONNIFY_SECRET_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | To access some endpoints such as the Reserved Account APIs,
    | you first need to get an access token by authenticating with secret key
    | and api key. See your Monnify dashboard to get your api key.
    |
    */
    'api_key' => env('MONNIFY_API_KEY', '')
];
