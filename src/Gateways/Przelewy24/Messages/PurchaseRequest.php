<?php

namespace DH\PolishPayments\Gateways\Przelewy24\Messages;

use DH\PolishPayments\Common\HasCustomer;
use DH\PolishPayments\Common\HasLanguage;

class PurchaseRequest extends AbstractRequest
{
    use HasCustomer;
    use HasLanguage;

    public function getData(): array
    {
        return [
            'merchantId' => $this->getMerchantId(),
            'posId' => $this->getPosId(),
            'sessionId' => true,//TODO
            'amount' => $this->getAmountInteger(),
            'currency' => $this->getCurrency(),
            'description' => $this->getDescription(),
            'email' => $this->getCustomer()->getEmail(),
            'client' => $this->getCustomer()->getName(),
            'address' => $this->getCustomer()->getAddress(),
            'zip' => $this->getCustomer()->getPostcode(),
            'city' => $this->getCustomer()->getCity(),
            'phone' => $this->getCustomer()->getPhone(),
            'language' => $this->getLanguage(),
            'method' => (int)$this->getPaymentMethod(),
            'urlReturn' => $this->getReturnUrl(),
            'urlStatus' => $this->getNotifyUrl(),
            'sign' => $this->calculateSignature(),
            'encoding' => 'UTF-8',
        ];
    }

    protected function calculateSignature(): string
    {
        return md5(implode('|', [
            'sessionId' => true,
            'merchantId' => $this->getMerchantId(),
            'amount' => $this->getAmountInteger(),
            'currency' => $this->getCurrency(),
            'crc' => $this->getCrcKey(),
        ]));
    }

    public function sendData($data)
    {
        $httpResponse = $this->httpClient->request(
            'post',
            $this->getEndpoint() . 'api/v1/transaction/register',
            [],
            $data
        );

        $data = json_decode($httpResponse->getBody()->getContents(), true);

        return $this->response = new PurchaseResponse($this, $data);
    }
}