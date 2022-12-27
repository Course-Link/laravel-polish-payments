<?php

namespace DH\PolishPayments\Gateways\PayNow\Messages;

use DH\PolishPayments\Gateways\PayNow\HasPayNowCredentials;
use Omnipay\Common\Message\AbstractRequest as BaseRequest;

abstract class AbstractRequest extends BaseRequest
{
    use HasPayNowCredentials;

    protected string $endpoint = 'https://api.paynow.pl/';
    protected string $sandboxEndpoint = 'https://api.sandbox.paynow.pl/';

    public function getEndpoint(): string
    {
        if ($this->getTestMode()) {
            return $this->sandboxEndpoint;
        }

        return $this->endpoint;
    }
}