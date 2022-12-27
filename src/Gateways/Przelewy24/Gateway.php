<?php

namespace DH\PolishPayments\Gateways\Przelewy24;

use DH\PolishPayments\Gateways\Przelewy24\Messages\PurchaseRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;

class Gateway extends AbstractGateway
{
    use HasPrzelewy24Credentials;

    public function getName(): string
    {
        return 'Przelewy24';
    }

    public function purchase(array $options = []): RequestInterface
    {
        return $this->createRequest(
            PurchaseRequest::class,
            $options,
        );
    }
}