<?php

use DH\PolishPayments\GatewayManager;
use DH\PolishPayments\Gateways\Tpay\Gateway;
use Omnipay\Common\Message\NotificationInterface;

function setupTpayGateway(array $config = []): Gateway
{
    $manager = resolve(GatewayManager::class);
    return $manager->gateway(Gateway::class, $config);
}

it('resolves tpay gateway', function () {
    $gateway = setupTpayGateway();

    expect($gateway)->toBeInstanceOf(Gateway::class);
});

it('supports purchase', function () {
    $gateway = setupTpayGateway();

    expect($gateway->supportsPurchase())->toBeTrue();
});

it('can make a purchase', function () {
    $gateway = setupTpayGateway([
        'client_id' => '1010-e5736adfd4bc5d8c',
        'client_secret' => '493e01af815383a687b747675010f65d1eefaeb42f63cfe197e7b30f14a556b7',
        'security_code' => 'demo',
        'merchant_id' => '1010',
        'test_mode' => true,
    ]);

    $purchase = $gateway->purchase([
        'customer' => setupCustomer(),
        'language' => 'pl',
        'amount' => 99.99,
        'description' => 'Ebook',
    ])->send();

    expect($purchase->isSuccessful())->toBeFalse()
        ->and($purchase->isRedirect())->toBeTrue();
});

it('support accepting notification', function () {
    $gateway = setupTpayGateway();

    expect($gateway->supportsAcceptNotification());
});

it('can accept a notification', function () {
    $gateway = setupTpayGateway([
        'client_id' => '1010-e5736adfd4bc5d8c',
        'client_secret' => '493e01af815383a687b747675010f65d1eefaeb42f63cfe197e7b30f14a556b7',
        'security_code' => 'demo',
        'merchant_id' => '1010',
        'test_mode' => true,
    ]);

    $notification = $gateway->acceptNotification([
        'id' => 1010,
        'tr_id' => 'TR-BRA-TST3X',
        'tr_date' => '2022-12-28 17:27:31',
        'tr_crc' => 'test',
        'tr_amount' => 25.55,
        'tr_paid' => 25.55,
        'tr_desc' => 'Ebook',
        'tr_status' => 'TRUE',
        'tr_error' => 'none',
        'tr_email' => 'johnny@example.com',
        'md5sum' => '6fec7f6cf1afb7d2bce1fabfd2f77858',
        'ip_address' => '195.149.229.109'
    ]);

    expect($notification->getTransactionStatus())->toEqual(NotificationInterface::STATUS_COMPLETED)
        ->and($notification->getTransactionReference())->toEqual('TR-BRA-TST3X')
        ->and($notification->getMessage())->toEqual('none');
});

it('can handle a failed notification', function () {
    $gateway = setupTpayGateway([
        'client_id' => '1010-e5736adfd4bc5d8c',
        'client_secret' => '493e01af815383a687b747675010f65d1eefaeb42f63cfe197e7b30f14a556b7',
        'security_code' => 'demo',
        'merchant_id' => '1010',
        'test_mode' => true,
    ]);

    $notification = $gateway->acceptNotification([
        'id' => 1010,
        'tr_id' => 'TR-BRA-TST4X',
        'tr_date' => '2022-12-28 17:27:31',
        'tr_crc' => 'test',
        'tr_amount' => 25.55,
        'tr_paid' => 25.55,
        'tr_desc' => 'Ebook',
        'tr_status' => 'TRUE',
        'tr_error' => 'none',
        'tr_email' => 'johnny@example.com',
        'md5sum' => '6fec7f6cf1afb7d2bce1fabfd2f77858',
    ]);

    expect($notification->getTransactionStatus())->toEqual(NotificationInterface::STATUS_FAILED)
        ->and($notification->getTransactionReference())->toEqual('TR-BRA-TST4X')
        ->and($notification->getMessage())->toEqual('none');
});