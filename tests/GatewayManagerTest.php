<?php

it('resolves gateway by short name', function () {
    $manager = getGatewayManager();

    $gateway = $manager->gateway('imoje');

    expect($gateway)->toBeInstanceOf(Omnipay\imoje\Gateway::class);

    $gateway = $manager->gateway('Paynow');

    expect($gateway)->toBeInstanceOf(Omnipay\Paynow\Gateway::class);

    $gateway = $manager->gateway('PayU');

    expect($gateway)->toBeInstanceOf(Omnipay\PayU\Gateway::class);

    $gateway = $manager->gateway('Przelewy24');

    expect($gateway)->toBeInstanceOf(Omnipay\Przelewy24\Gateway::class);

    $gateway = $manager->gateway('Tpay');

    expect($gateway)->toBeInstanceOf(Omnipay\Tpay\Gateway::class);
});

it('can have a default gateway', function () {
    $manager = getGatewayManager();

    expect($manager->getDefaultGateway())->toEqual('Paynow');
});