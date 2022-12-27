<?php

namespace DH\PolishPayments\Gateways\PayU\Messages;

use Omnipay\Common\Message\AbstractResponse;

class TokenResponse extends AbstractResponse
{
    public function isSuccessful(): bool
    {
        return isset($this->data['access_token']);
    }
}