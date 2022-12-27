<?php

namespace DH\PolishPayments\Gateways\PayNow;

use DH\PolishPayments\Gateways\PayNow\Messages\CompletePurchaseRequest;
use DH\PolishPayments\Gateways\PayNow\Messages\PurchaseRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;

class Gateway extends AbstractGateway
{
    use HasPayNowCredentials;

    public function getName(): string
    {
        return 'paynow';
    }

    public function purchase(array $options = array()): RequestInterface
    {
        return $this->createRequest(
            PurchaseRequest::class,
            array_merge($this->getParameters(), $options),
        );
    }

    public function completePurchase(array $options = array()): RequestInterface
    {
        return $this->createRequest(
            CompletePurchaseRequest::class,
            array_merge($this->getParameters(), $options),
        );
    }
}