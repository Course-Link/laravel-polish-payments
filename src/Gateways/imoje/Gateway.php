<?php

namespace DH\PolishPayments\Gateways\imoje;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    public function getName(): string
    {
        return 'imoje';
    }
}