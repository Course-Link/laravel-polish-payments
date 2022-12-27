<?php

namespace DH\PolishPayments\Gateways\PayNow\Messages;

use DH\PolishPayments\Common\HasCustomer;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Str;

class PurchaseRequest extends AbstractRequest
{
    use HasCustomer;

    public function getData(): array
    {
        return [
            'amount' => $this->getAmountInteger(),
            'currency' => $this->getCurrency(),
            'description' => $this->getDescription(),
            'continueUrl' => $this->getReturnUrl(),
            'externalId' => $this->getTransactionId(),
            'buyer' => [
                'email' => $this->getCustomer()->getEmail(),
            ],
        ];
    }

    public function sendData($data): PurchaseResponse
    {
        $httpResponse = $this->httpClient->request(
            'post',
            $this->getEndpoint() . 'v1/payments',
            [
                'Api-Key' => $this->getApiKey(),
                'Signature' => $this->calculateSignature($data),
                'Idempotency-Key' => Str::limit(uniqid($this->getTransactionId() . '_'), 44, ''),
            ],
            $data,
        );

        if ($httpResponse instanceof Response) {
            $data = $httpResponse->json();
        } else {
            $data = json_decode($httpResponse->getBody()->getContents(), true);
        }

        return $this->response = new PurchaseResponse($this, $data);
    }
}