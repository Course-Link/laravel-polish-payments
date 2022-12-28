<?php

use DH\PolishPayments\GatewayManager;
use DH\PolishPayments\Gateways\Przelewy24\Gateway;

function setupGateway(array $config = []): Gateway
{
    $manager = resolve(GatewayManager::class);
    return $manager->gateway(Gateway::class, $config);
}

it('resolves przelewy24 gateway', function () {
   $gateway = setupTpayGateway();

   expect($gateway)->toBeInstanceOf(Gateway::class);
});

it('supports purchase', function () {
    $gateway = setupTpayGateway();

    expect($gateway->supportsPurchase())->toBeTrue();
});