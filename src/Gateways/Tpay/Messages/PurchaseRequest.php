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
            'method' => 'create',
            'test_mode' => $this->getTestMode(),
            'merchant_id' => $this->getMerchantId(),
            'name' => $this->getCustomer()->getName(),
            'address' => $this->getCustomer()->getAddress(),
            'email' => $this->getCustomer()->getEmail(),
            'city' => $this->getCustomer()->getCity(),
            'zip' => $this->getCustomer()->getPostcode(),
            'country' => $this->getCustomer()->getCountry(),
            'phone' => $this->getCustomer()->getPhone(),
            'api_password' => $this->getApiPassword(),
            'amount' => $this->getAmount(),
            'description' => $this->getDescription(),
            'crc' => $this->getTransactionId(),
            'md5sum' => $this->getMd5Sum(),
            'group' => (int)$this->getPaymentMethod(),
            'language' => $this->getLanguage(),
            'result_url' => 'https://shop.tpay.com/shop-endpoint',
            'return_url' => 'https://shop.tpay.com/success',
            'return_error_url' => 'https://shop.tpay.com/error',
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
            $this->endpoint . $this->getApiKey() . '/transaction/create',
            [],
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