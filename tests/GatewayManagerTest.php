<?php

it('resolves gateway by short name', function () {
    $manager = getGatewayManager();

    $gateway = $manager->driver('imoje');

    expect($gateway)->toBeInstanceOf(Omnipay\imoje\Gateway::class);

    $gateway = $manager->driver('Paynow');

    expect($gateway)->toBeInstanceOf(Omnipay\Paynow\Gateway::class);

    $gateway = $manager->driver('PayU');

    expect($gateway)->toBeInstanceOf(Omnipay\PayU\Gateway::class);

    $gateway = $manager->driver('Przelewy24');

    expect($gateway)->toBeInstanceOf(Omnipay\Przelewy24\Gateway::class);

    $gateway = $manager->driver('Tpay');

    expect($gateway)->toBeInstanceOf(Omnipay\Tpay\Gateway::class);
});

it('can have a default gateway', function () {
    $manager = getGatewayManager();

    expect($manager->getDefaultDriver())->toEqual('Paynow');
});