<?php

use DH\PolishPayments\GatewayManager;

it('resolves gateway manager', function () {
    $manager = resolve(GatewayManager::class);



    dd($manager);
});