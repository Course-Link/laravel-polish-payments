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

    'default' => env('OMNIPAY_GATEWAY', 'Paynow'),

    /*
    |--------------------------------------------------------------------------
    | HTTP Client
    |--------------------------------------------------------------------------
    |
    | Here you can specify the gateway that the facade should use by default.
    |
    */

    'http_client' => CourseLink\Payments\Http\HttpClient::class,

    /*
    |--------------------------------------------------------------------------
    | Automatically Handle Notifications
    |--------------------------------------------------------------------------
    |
    | If this setting is enabled, Omnipay will listen for notifications and
    | dispatch event.
    |
    */

    'handle_notifications' => env('OMNIPAY_NOTIFICATIONS'),

    /*
    |--------------------------------------------------------------------------
    | Automatically Complete Payments
    |--------------------------------------------------------------------------
    |
    | If this setting is enabled, Omnipay will automatically complete payments
    | after receiving notification.
    |
    */

    'auto_payment_completion' => env('OMNIPAY_COMPLETE_PAYMENTS'),

    /*
    |--------------------------------------------------------------------------
    | Omnipay Path
    |--------------------------------------------------------------------------
    |
    | This is the base URI path where Omnipay's views, such as the payment
    | notification handle, will be available from. You're free to tweak
    | this path according to your preferences and application design.
    |
    */

    'path' => 'omnipay',

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
            'auth_token' => env('IMOJE_AUTH_TOKEN', ''),
            'pos_key' => env('IMOJE_POS_KEY', ''),
            'pos_id' => env('IMOJE_POS_ID', ''),
            'merchant_id' => env('IMOJE_MERCHANT_ID', ''),
            'test_mode' => env('IMOJE_TEST_MODE', false),
        ],
        'paynow' => [
            'api_key' => env('PAYNOW_API_KEY'),
            'signature_key' => env('PAYNOW_SIGNATURE_KEY'),
            'test_mode' => env('PAYNOW_TEST_MODE', false),
        ],
        'payu' => [
            'pos_id' => env('PAYU_POS_ID'),
            'signature_key' => env('PAYU_SIGNATURE_KEY'),
            'client_id' => env('PAYU_CLIENT_ID'),
            'client_secret' => env('PAYU_CLIENT_SECRET'),
            'test_mode' => env('PAYU_TEST_MODE', false),
        ],
        'przelewy24' => [
            'secret_id' => env('PRZELEWY24_SECRET_ID'),
            'pos_id' => env('PRZELEWY24_POS_ID'),
            'crc_key' => env('PRZELEWY24_CRC_KEY'),
            'merchant_id' => env('PRZELEWY24_MERCHANT_ID'),
            'test_mode' => env('PRZELEWY24_TEST_MODE', false),
            'verify_ip_address' => env('PRZELEWY24_VERIFY_IP_ADDRESS', true),
            'notification_ip_addresses' => [
                '91.216.191.181',
                '91.216.191.182',
                '91.216.191.183',
                '91.216.191.184',
                '91.216.191.185',
                '5.252.202.254',
                '5.252.202.255',
            ],
        ],
        'tpay' => [
            'client_id' => env('TPAY_CLIENT_ID'),
            'client_secret' => env('TPAY_CLIENT_SECRET'),
            'security_code' => env('TPAY_SECURITY_CODE'),
            'merchant_id' => env('TPAY_MERCHANT_ID'),
            'test_mode' => env('TPAY_TEST_MODE', false),
            'verify_ip_address' => env('TPAY_VERIFY_IP_ADDRESS', true),
            'notification_ip_addresses' => [
                '195.149.229.109',
                '148.251.96.163',
                '178.32.201.77',
                '46.248.167.59',
                '46.29.19.106',
                '176.119.38.175',
            ]
        ]
    ],

];