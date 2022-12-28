<?php

namespace DH\PolishPayments\OAuth;

interface TokenCacheClientInterface
{
    public function getTokenForGateway(string $class): string;

    public function rememberTokenForGateway(string $class, string $token);
}