<?php

namespace DH\PolishPayments;

use DH\PolishPayments\Client\LaravelHttpClient;
use Illuminate\Support\ServiceProvider;
use Omnipay\Common\GatewayFactory;

class PolishPaymentsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(GatewayManager::class, function ($app) {
            return new GatewayManager($app, new GatewayFactory, new LaravelHttpClient);
        });
    }
}