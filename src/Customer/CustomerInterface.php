<?php

namespace DH\PolishPayments\Common;

interface CustomerInterface
{
    public function getName(): string;

    public function getFirstName(): string;

    public function getLastName(): string;

    public function getEmail(): string;

    public function getAddress(): string;

    public function getPostcode(): string;

    public function getPhone(): ?string;

    public function getCity(): string;

    public function getCountry(): string;
}