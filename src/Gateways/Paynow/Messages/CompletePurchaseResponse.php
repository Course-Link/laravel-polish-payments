<?php

namespace DH\PolishPayments\Gateways\PayNow\Messages;

use DH\PolishPayments\Gateways\PayNow\HasPayNowCredentials;
use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    public function isSuccessful(): bool
    {
        return $this->checkSignature() && $this->data['status'] === 'CONFIRMED';
    }

    private function checkSignature(): bool
    {
        return $this->request->calculateSignature($this->data) === $this->request->getSignature();
    }
}