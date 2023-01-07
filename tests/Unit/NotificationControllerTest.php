<?php

use CourseLink\Payments\Http\Controllers\NotificationController;
use Illuminate\Http\Request;

it('returns normal response if gateway is missing', function () {
    $request = Request::create(
        '/', 'POST', [], [], [], [], json_encode(['type' => 'test', 'id' => 'event-id'])
    );

    $response = (new NotificationController)->handleNotification('laravel', getGatewayManager());

    expect($response->getContent())->toBeEmpty();
});

it('can have notification route registered', function () {
    expect(route('omnipay.webhook', 'laravel', false))
        ->toEqual('/omnipay/laravel/webhook');
});