<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Gateway
    |--------------------------------------------------------------------------
    |
    | Here you can specify the gateway that the facade should use by default.
    |
    */
    'default' => env('POLISH_PAYMENTS_GATEWAY', 'paynow'),

    /*
    |--------------------------------------------------------------------------
    | Gateway specific settings
    |--------------------------------------------------------------------------
    |
    | Here you can specify gateway specific settings.
    |
    */
    'gateways' => [
        'imoje' => [
            'driver' => DH\PolishPayments\Gateways\imoje\Gateway::class,
            'auth_token' => env('IMOJE_AUTH_TOKEN'),
            'pos_key' => env('IMOJE_POS_KEY'),
            'pos_id' => env('IMOJE_POS_ID'),
            'merchant_id' => env('IMOJE_MERCHANT_ID'),
            'test_mode' => env('IMOJE_TEST_MODE', false),
        ],
        'paynow' => [
            'driver' => DH\PolishPayments\Gateways\PayNow\Gateway::class,
            'api_key' => env('PAYNOW_API_KEY'),
            'signature_key' => env('PAYNOW_SIGNATURE_KEY'),
            'test_mode' => env('PAYNOW_TEST_MODE', false),
        ],
        'payu' => [
            'driver' => DH\PolishPayments\Gateways\PayU\Gateway::class,
            'pos_id' => env('PAYU_POS_ID'),
            'signature_key' => env('PAYU_SIGNATURE_KEY'),
            'client_id' => env('PAYU_CLIENT_ID'),
            'client_secret' => env('PAYU_CLIENT_SECRET'),
            'test_mode' => env('PAYU_TEST_MODE', false),
        ],
        'przelewy24' => [
            'driver' => DH\PolishPayments\Gateways\Przelewy24\Gateway::class,
            'secret_id' => env('PRZELEWY24_SECRET_ID'),
            'pos_id' => env('PRZELEWY24_POS_ID'),
            'crc_key' => env('PRZELEWY24_CRC_KEY'),
            'merchant_id' => env('PRZELEWY24_MERCHANT_ID'),
            'test_mode' => env('PRZELEWY24_TEST_MODE', false),
        ],
        'tpay' => [
            'driver' => DH\PolishPayments\Gateways\Tpay\Gateway::class,
            'client_id' => env('TPAY_CLIENT_ID'),
            'client_secret' => env('TPAY_CLIENT_SECRET'),
            'security_code' => env('TPAY_SECURITY_CODE'),
            'merchant_id' => env('TPAY_MERCHANT_ID'),
            'test_mode' => env('TPAY_TEST_MODE', false),
        ]
    ],
];