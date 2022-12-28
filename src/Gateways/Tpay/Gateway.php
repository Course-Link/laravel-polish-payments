<?php

namespace DH\PolishPayments\Gateways\Tpay;

use DH\PolishPayments\Gateways\Tpay\Messages\Notification;
use DH\PolishPayments\OAuth\HasOAuth2Token;
use DH\PolishPayments\OAuth\OAuth2TokenInterface;
use DH\PolishPayments\Gateways\Tpay\Messages\PurchaseRequest;
use DH\PolishPayments\Gateways\Tpay\Messages\TokenRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\NotificationInterface;

class Gateway extends AbstractGateway implements OAuth2TokenInterface
{
    use HasOAuth2Token;
    use HasTpayCredentials;

    public function getName(): string
    {
        return 'tpay';
    }

    public function createRequest($class, array $parameters): AbstractRequest
    {
        if (!$this->hasToken() && $class !== TokenRequest::class) {
            $this->getToken(true);
        }

        return parent::createRequest($class, $parameters);
    }

    public function createToken(): AbstractRequest
    {
        return $this->createRequest(
            TokenRequest::class,
            []
        );
    }

    public function purchase(array $options = array()): AbstractRequest
    {
        return $this->createRequest(
            PurchaseRequest::class,
            $options,
        );
    }

    public function acceptNotification(array $options = []): NotificationInterface
    {
        return new Notification(
            $this,
            $options
        );
    }
}