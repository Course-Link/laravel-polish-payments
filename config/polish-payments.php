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
            'api_key' => env('TPAY_API_KEY'),
            'api_password' => env('TPAY_API_PASSWORD'),
            'security_code' => env('TPAY_SECURITY_CODE'),
            'merchant_id' => env('TPAY_MERCHANT_ID'),
            'test_mode' => env('TPAY_TEST_MODE', false),
        ]
    ],
];