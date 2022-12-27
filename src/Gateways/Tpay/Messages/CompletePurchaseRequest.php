<?php

namespace DH\PolishPayments\Gateways\Tpay\Messages;

class CompletePurchaseRequest extends AbstractRequest
{


    public function getData()
    {
        return [
            'id' => '',
            'tr_id' => '',
            'tr_date' => '',
            'tr_crc' => '',
            'tr_amount' => '',
            'tr_desc' => '',
            'tr_status' => '',
            'tr_error' => '',
            'tr_email' => '',
            'md5sum' => '',
            'test_mode' => '',
        ];
    }

    public function sendData($data): CompletePurchaseResponse
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}