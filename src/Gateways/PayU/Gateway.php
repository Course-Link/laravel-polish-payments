<?php

namespace DH\PolishPayments\Gateways\PayU;

use DH\PolishPayments\Common\HasOAuth2Token;
use DH\PolishPayments\Common\OAuth2TokenInterface;
use DH\PolishPayments\Gateways\PayU\Messages\PurchaseRequest;
use DH\PolishPayments\Gateways\PayU\Messages\TokenRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;

class Gateway extends AbstractGateway implements OAuth2TokenInterface
{
    use HasOAuth2Token;
    use HasPayUCredentials;

    public function getName(): string
    {
        return 'PayU';
    }

    public function createRequest($class, array $parameters): RequestInterface
    {
        if (!$this->hasToken() && $class !== TokenRequest::class) {
            $this->getToken(true);
        }

        return parent::createRequest($class, $parameters); // TODO: Change the autogenerated stub
    }

    public function createToken(): RequestInterface
    {
        return $this->createRequest(
            TokenRequest::class,
            []
        );
    }

    public function purchase(array $options = []): RequestInterface
    {
        return $this->createRequest(
            PurchaseRequest::class,
            $options
        );
    }
}