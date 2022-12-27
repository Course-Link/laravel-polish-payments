<?php

use DH\PolishPayments\GatewayManager;
use DH\PolishPayments\Gateways\PayNow\Gateway;
use DH\PolishPayments\Gateways\PayNow\Messages\CompletePurchaseRequest;
use DH\PolishPayments\Gateways\PayNow\Messages\PurchaseRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->manager = resolve(GatewayManager::class);
    $this->gateway = $this->manager->gateway(Gateway::class, [
        'api_key' => 'TEST',
        'signature_key' => 'Test',
        'test_mode' => true,
    ]);
    $this->customer = setupCustomer();
});

it('can make a purchase', function () {
    /** @var PurchaseRequest $purchase */
    $purchase = $this->gateway->purchase([
        'customer' => $this->customer,
    ]);

    Http::fake([
        'https://api.sandbox.paynow.pl/v1/payments' => function (Request $request) {
            expect($request->header('Api-Key')[0])->toEqual('TEST');

            return Http::response([
                "redirectUrl" => "https://paywall.sandbox.paynow.pl/NOLV-8F9-08K-WGD?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwb3NJZCI6IjEwMDAiLCJwYXltZW50SWQiOiJOT0xWLThGOS0wOEstV0dEIiwiZXhwIjoxNTU0ODEzMTY4fQ.71TLjI8U8p0c_hhC1Nj3cAPU3mtzYW4ylGo8qVeB18o",
                "paymentId" => "NOLV-8F9-08K-WGD",
                "status" => "NEW"
            ]);
        }
    ]);

    $response = $purchase->send();

    expect($response->isRedirect())->toBeTrue()
        ->and($response->isSuccessful())->toBeFalse();
});

it('can complete a purchase', function () {
    /** @var CompletePurchaseRequest $completePurchase */
    $completePurchase = $this->gateway->completePurchase([
        'signature' => "89Uaig8eUlFy7SVhTg9EdKsD41uynItTVVbOLIjykB0=",
        "paymentId" => "NOLV-8F9-08K-WGD",
        "externalId" => "9fea23c7-cd5c-4884-9842-6f8592be65df",
        "status" => "CONFIRMED",
        "modifiedAt" => "2018-12-12T13:24:52"
    ]);

    $response = $completePurchase->send();

    expect($response->isSuccessful())->toBeTrue();
});