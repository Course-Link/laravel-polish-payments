<?php

namespace DH\PolishPayments\Gateways\PayNow\Messages;

class CompletePurchaseRequest extends AbstractRequest
{
    public function getPaymentId(): string
    {
        return $this->getParameter('paymentId');
    }

    public function setPaymentId(string $value): AbstractRequest
    {
        return $this->setParameter('paymentId', $value);
    }

    public function getStatus(): string
    {
        return $this->getParameter('status');
    }

    public function setStatus(string $value): AbstractRequest
    {
        return $this->setParameter('status', $value);
    }

    public function getSignature(): string
    {
        return $this->getParameter('signature');
    }

    public function setSignature(string $value): AbstractRequest
    {
        return $this->setParameter('signature', $value);
    }

    public function getExternalId(): string
    {
        return $this->getParameter('externalId');
    }

    public function setExternalId(string $value): AbstractRequest
    {
        return $this->setParameter('externalId', $value);
    }

    public function getModifiedAt(): string
    {
        return $this->getParameter('modifiedAt');
    }

    public function setModifiedAt(string $value): AbstractRequest
    {
        return $this->setParameter('modifiedAt', $value);
    }

    public function getData(): array
    {
        return [
            'paymentId' => $this->getPaymentId(),
            'externalId' => $this->getExternalId(),
            'status' => $this->getStatus(),
            'modifiedAt' => $this->getModifiedAt(),
        ];
    }

    public function sendData($data): CompletePurchaseResponse
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}