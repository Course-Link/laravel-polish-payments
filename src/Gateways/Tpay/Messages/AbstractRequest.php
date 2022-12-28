<?php

namespace DH\PolishPayments\Gateways\Tpay\Messages;

use DH\PolishPayments\Common\HasLanguage;
use DH\PolishPayments\OAuth\HasOAuth2Token;
use DH\PolishPayments\Gateways\Tpay\HasTpayCredentials;
use Omnipay\Common\Message\AbstractRequest as BaseRequest;

abstract class AbstractRequest extends BaseRequest
{
    use HasTpayCredentials;
    use HasOAuth2Token;
    use HasLanguage;

    protected string $endpoint = 'https://api.tpay.com';

    protected string $sandboxEndpoint = 'https://api.tpay.com';

    protected array $supportedLanguages = ['pl', 'en', 'fr', 'es', 'it', 'ru'];

    public function getEndpoint(): string
    {
        return $this->getTestMode() ? $this->sandboxEndpoint : $this->endpoint;
    }
}