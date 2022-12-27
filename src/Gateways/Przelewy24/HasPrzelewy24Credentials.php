<?php

namespace DH\PolishPayments\Gateways\Przelewy24;

trait HasPrzelewy24Credentials
{
    public function getPosId(): string
    {
        return $this->getParameter('posId');
    }

    public function setPosId(string $value): self
    {
        return $this->setParameter('posId', $value);
    }

    public function getMerchantId(): string
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId(string $value): self
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getCrcKey(): string
    {
        return $this->getParameter('crcKey');
    }

    public function setCrcKey(string $value): self
    {
        return $this->setParameter('crcKey', $value);
    }
}