<?php

namespace CourseLink\Payments\Http;

use Illuminate\Support\Facades\Http;
use Omnipay\Common\Http\ClientInterface;

class HttpClient implements ClientInterface
{
    public function request($method, $uri, array $headers = [], $body = null, $protocolVersion = '1.1')
    {
        $request = Http::withOptions([
            'allow_redirects' => false,
        ])->withHeaders($headers)
            ->withBody($body, $headers['Content-Type'] ?? 'application/json');

        return $request->$method($uri);
    }
}