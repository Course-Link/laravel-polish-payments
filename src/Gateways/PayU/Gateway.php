<?php

namespace DH\PolishPayments\Gateways\PayU;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    use HasPayUCredentials;

    public function getName(): string
    {
        return 'PayU';
    }
}