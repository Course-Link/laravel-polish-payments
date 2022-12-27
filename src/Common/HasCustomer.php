<?php

namespace DH\PolishPayments\Common;

use Omnipay\Common\ParametersTrait;

trait HasCustomer
{
    use ParametersTrait {
        setParameter as traitSetParameter;
    }

    public function getCustomer(): ?Customer
    {
        return $this->getParameter('customer');
    }

    public function setCustomer(Customer|array $customer): self
    {
        if ($customer && ! $customer instanceof Customer) {
            $customer = new Customer($customer);
        }

        return $this->setParameter('customer', $customer);
    }
}