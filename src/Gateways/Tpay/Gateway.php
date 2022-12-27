<?php

namespace DH\PolishPayments\Gateways\Tpay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;

class Gateway extends AbstractGateway
{
    use HasTpayCredentials;

    public function getName(): string
    {
        return 'Tpay';
    }


}