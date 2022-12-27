<?php

namespace DH\PolishPayments\Client;

use Illuminate\Support\Facades\Http;
use Omnipay\Common\Http\ClientInterface;

class LaravelHttpClient implements ClientInterface
{
    public function request($method, $uri, array $headers = [], $body = null, $protocolVersion = '1.1')
    {
        $request = Http::withOptions([
            'allow_redirects' => false,
        ])->withHeaders($headers);

        if (isset($headers['Content-Type']) && $headers['Content-Type'] === 'application/x-www-form-urlencoded') {
            $request = $request->asForm();
        }

        return $request->$method($uri, $body);
    }
}