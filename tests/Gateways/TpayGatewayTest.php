<?php

use DH\PolishPayments\GatewayManager;
use DH\PolishPayments\Gateways\Tpay\Gateway;

function setupGateway(array $config = []): Gateway
{
    $manager = resolve(GatewayManager::class);
    return $manager->gateway(Gateway::class, $config);
}

it('resolves tpay gateway', function () {
    $gateway = setupGateway();

    expect($gateway)->toBeInstanceOf(Gateway::class);
});

it('supports purchase', function () {
    $gateway = setupGateway();

    expect($gateway->supportsPurchase())->toBeTrue();
});

it('can make a purchase', function () {
    $gateway = setupGateway([
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

it('support completing the purchase', function () {
    $gateway = setupGateway();

    expect($gateway->supportsCompletePurchase());
});

it('sets purchase request correctly', function () {

});

it('can complete a purchase', function () {

});