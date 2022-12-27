<?php

use DH\PolishPayments\Common\Customer;
use DH\PolishPayments\Tests\TestCase;

uses(TestCase::class)->in('.');

function setupCustomer(): Customer
{
    return new Customer([
        'name' => 'John Doe',
        'firstName' => 'John',
        'lastName' => 'Doe',
        'email' => 'johnny@example.com',
        'address' => 'Testowa 25',
        'city' => 'Warszawa',
        'postcode' => '00-000',
        'country' => 'PL'
    ]);
}