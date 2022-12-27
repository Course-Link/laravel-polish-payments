<?php

namespace DH\PolishPayments\Gateways\Tpay\Messages;

use DH\PolishPayments\Common\HasCustomer;
use Illuminate\Http\Client\Response;

class PurchaseRequest extends AbstractRequest
{
    use HasCustomer;

    public function getData(): array
    {
        return [
            'amount' => $this->getAmount(),
            'description' => $this->getDescription(),
            'payer' => [
                'email' => $this->getCustomer()->getEmail(),
                'name' => $this->getCustomer()->getName(),
            ],
            'pay' => [
                'groupId' => 150,
            ]
        ];
    }


    protected function getMd5Sum(): string
    {
        return md5(implode('&', [
            $this->getMerchantId(),
            $this->getAmount(),
            $this->getTransactionId(),
            $this->getSecurityCode(),
        ]));
    }

    public function sendData($data): PurchaseResponse
    {
        $httpResponse = $this->httpClient->request(
            'post',
            $this->getEndpoint() . '/transactions',
            [
                'Authorization' => 'Bearer ' . $this->getToken(),
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