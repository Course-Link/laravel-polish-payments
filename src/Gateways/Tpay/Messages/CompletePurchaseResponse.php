<?php

namespace DH\PolishPayments\Gateways\Tpay\Messages;

use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    public function isRedirect(): bool
    {
        return false;
    }

    public function isSuccessful(): bool
    {
        return $this->checkStatus() && $this->checkMd5Sum();
    }

    public function getTransactionReference()
    {
        return $this->data['tr_id'];
    }

    public function checkStatus(): bool
    {
        return $this->data['tr_status'] === 'TRUE' && $this->data['tr_error'] === 'none';
    }

    protected function checkMd5Sum(): bool
    {
        return false;
    }


}