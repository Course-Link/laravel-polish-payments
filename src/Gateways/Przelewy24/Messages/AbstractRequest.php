<?php

namespace DH\PolishPayments\Gateways\Przelewy24\Messages;

use DH\PolishPayments\Gateways\Przelewy24\HasPrzelewy24Credentials;
use Omnipay\Common\Message\AbstractRequest as BaseRequest;

abstract class AbstractRequest extends BaseRequest
{
    use HasPrzelewy24Credentials;

    protected string $endpoint = ' https://secure.przelewy24.pl/';

    protected string $sandboxEndpoint = 'https://sandbox.przelewy24.pl/';

    public function getEndpoint(): string
    {
        if ($this->getTestMode()) {
            return $this->sandboxEndpoint;
        }

        return $this->endpoint;
    }
}