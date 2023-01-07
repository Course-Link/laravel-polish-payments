<?php

use CourseLink\Payments\Events\NotificationHandled;
use Illuminate\Support\Facades\Event;
use function Pest\Laravel\postJson;

it('handles notifications for imoje', function () {
    Event::fake();
    $response = postJson(route('omnipay.webhook', 'imoje'));
    Event::assertDispatchedTimes(NotificationHandled::class, 1);
    $response->assertStatus(200);
});

it('handles notifications for paynow', function () {
    Event::fake();
    $response = postJson(route('omnipay.webhook', 'Paynow'));
    Event::assertDispatchedTimes(NotificationHandled::class, 1);
    $response->assertStatus(200);
});

it('handles notifications for payu', function () {
    Event::fake();
    $response = postJson(route('omnipay.webhook', 'PayU'));
    Event::assertDispatchedTimes(NotificationHandled::class, 1);
    $response->assertStatus(200);
});

it('handles notifications for tpay', function () {
    Event::fake();
    $response = postJson(route('omnipay.webhook', 'Tpay'));
    Event::assertDispatchedTimes(NotificationHandled::class, 1);
    $response->assertStatus(200);
});