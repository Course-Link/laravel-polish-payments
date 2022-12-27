<?php

namespace DH\PolishPayments\Gateways\PayU\Messages;

use DH\PolishPayments\Common\HasLanguage;
use DH\PolishPayments\Common\HasOAuth2Token;
use DH\PolishPayments\Gateways\PayU\HasPayUCredentials;
use Omnipay\Common\Message\AbstractRequest as BaseRequest;
abstract class AbstractRequest extends BaseRequest
{
    use HasPayUCredentials;
    use HasOAuth2Token;
    use HasLanguage;

    protected string $endpoint = 'https://secure.payu.com';

    protected string $sandboxEndpoint = 'https://secure.snd.payu.com';

    public function getEndpoint(): string
    {
        return $this->getTestMode() ? $this->sandboxEndpoint : $this->endpoint;
    }
}