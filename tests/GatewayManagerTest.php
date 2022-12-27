<?php

use DH\PolishPayments\GatewayManager;
use DH\PolishPayments\Gateways\PayNow;

it('resolves gateway by short name', function () {
    $manager = getGatewayManager();

    $gateway = $manager->gateway('paynow');

    expect($gateway)->toBeInstanceOf(PayNow\Gateway::class);
});