<?php

namespace DH\PolishPayments\Gateways\Tpay\Messages;

use DH\PolishPayments\Gateways\Tpay\Gateway;
use Omnipay\Common\Message\NotificationInterface;

class Notification implements NotificationInterface
{
    public function __construct(
        protected Gateway $gateway,
        protected array   $data,
    )
    {
    }

    public function getData()
    {
        return $this->data;
    }

    public function getTransactionReference()
    {
        return $this->data['tr_id'];
    }

    public function getTransactionStatus(): string
    {
        return $this->checkStatus() ? NotificationInterface::STATUS_COMPLETED : NotificationInterface::STATUS_FAILED;
    }

    public function getMessage()
    {
        return $this->data['tr_error'];
    }

    protected function getMd5Sum(string $merchantId, float $amount, string $transactionId, string $crc, string $securityCode): string
    {
        return md5(implode('', [
            $merchantId,
            $transactionId,
            $amount,
            $crc,
            $securityCode,
        ]));
    }

    protected function checkStatus(): bool
    {
        if (
            $this->getMd5Sum(
                $this->gateway->getMerchantId(),
                $this->data['tr_amount'],
                $this->getTransactionReference(),
                $this->data['tr_crc'],
                $this->gateway->getSecurityCode(),
            ) !== $this->data['md5sum']
        ) {
            return false;
        }

        if (
            $this->gateway->getVerifyIpAddress() &&
            isset($this->data['ip_address']) &&
            !in_array($this->data['ip_address'], $this->gateway->getNotificationIpAddresses())
        ) {
            return false;
        }

        return true;
    }
}