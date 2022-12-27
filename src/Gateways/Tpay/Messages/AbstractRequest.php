<?php

namespace DH\PolishPayments\Gateways\Tpay\Messages;

use DH\PolishPayments\Gateways\Tpay\HasTpayCredentials;
use Omnipay\Common\Message\AbstractRequest as BaseRequest;

abstract class AbstractRequest extends BaseRequest
{
    use HasTpayCredentials;

    protected string $endpoint = 'https://secure.tpay.com/api/gw/';

    protected array $supportedLanguages = ['pl', 'en', 'fr', 'es', 'it', 'ru'];

    public function setLanguage(string $value): self
    {
        return $this->setParameter('language', $value);
    }

    public function getLanguage(): string
    {
        return $this->getParameter('language');
    }
}