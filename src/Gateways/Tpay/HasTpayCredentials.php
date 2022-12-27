<?php

namespace DH\PolishPayments\Gateways\Tpay;

trait HasTpayCredentials
{
    public function getApiKey(): string
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey(string $value): self
    {
        return $this->setParameter('apiKey', $value);
    }

    public function getApiPassword(): string
    {
        return $this->getParameter('apiPassword');
    }

    public function setApiPassword(string $value): self
    {
        return $this->setParameter('apiPassword', $value);
    }

    public function getMerchantId(): string
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId(string $value): self
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getSecurityCode(): string
    {
        return $this->getParameter('securityCode');
    }

    public function setSecurityCode(string $value): self
    {
        return $this->setParameter('securityCode', $value);
    }
}