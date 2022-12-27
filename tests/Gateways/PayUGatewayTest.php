<?php

use DH\PolishPayments\GatewayManager;
use DH\PolishPayments\Gateways\PayU\Gateway;

function setupGateway(array $config = []): Gateway
{
    $manager = resolve(GatewayManager::class);
    return $manager->gateway(Gateway::class, $config);
}

it('resolves payu gateway', function () {
    $gateway = setupGateway();

    expect($gateway)->toBeInstanceOf(Gateway::class);
});

it('supports purchase', function () {
    $gateway = setupGateway();

    expect($gateway->supportsPurchase())->toBeTrue();
});

it('can make a purchase', function () {
    $gateway = setupGateway([
        'pos_id' => 300746,
        'signature_key' => 'b6ca15b0d1020e8094d9b5f8d163db54',
        'client_id' => '300746',
        'client_secret' => '2ee86a66e5d97e3fadc400c9f19b065d',
        'test_mode' => true,
    ]);

    $purchase = $gateway->purchase([
        'customer' => setupCustomer(),
        'currency' => 'pln',
        'clientIp' => '127.0.0.1',
        'language' => 'pl',
        'amount' => 99.99,
        'description' => 'Ebook',
    ])->send();

    expect($purchase->isSuccessful())->toBeFalse()
        ->and($purchase->isRedirect())->toBeTrue();
});