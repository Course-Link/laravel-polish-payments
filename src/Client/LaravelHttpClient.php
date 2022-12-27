<?php

namespace DH\PolishPayments\Client;

use Illuminate\Support\Facades\Http;
use Omnipay\Common\Http\ClientInterface;

class LaravelHttpClient implements ClientInterface
{
    public function request($method, $uri, array $headers = [], $body = null, $protocolVersion = '1.1')
    {
        return Http::withHeaders($headers)
            ->$method($uri, $body);
    }
}