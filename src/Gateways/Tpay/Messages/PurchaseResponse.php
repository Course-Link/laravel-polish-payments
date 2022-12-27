<?php

namespace DH\PolishPayments\Gateways\Tpay\Messages;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful(): bool
    {
        return false;
    }

    public function isRedirect(): bool
    {
        return true;
    }

    public function getTransactionReference(): ?string
    {
        return $this->data['title'];
    }

    public function getRedirectUrl(): string
    {
        return $this->data['url'];
    }

    public function getRedirectMethod(): string
    {
        return 'GET';
    }
}