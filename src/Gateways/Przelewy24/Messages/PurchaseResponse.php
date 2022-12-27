<?php

namespace DH\PolishPayments\Gateways\Przelewy24\Messages;

use Omnipay\Common\Message\AbstractResponse;

class PurchaseResponse extends AbstractResponse
{
    public function isSuccessful(): bool
    {
        return false;
    }

    public function isRedirect(): bool
    {
        return isset(
                $this->data['responseCode'],
                $this->data['data']['token'],
            ) && $this->data['responseCode'] === 0;
    }

    public function getTransactionReference(): string
    {
        return $this->data['data']['token'];
    }

    public function getRedirectUrl(): string
    {
        return $this->request->getEndpoint() . 'trnRequest/' . $this->getTransactionReference();
    }
}