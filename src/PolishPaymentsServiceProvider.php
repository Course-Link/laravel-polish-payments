<?php

namespace DH\PolishPayments;

use DH\PolishPayments\Http\LaravelHttpClient;
use Illuminate\Support\ServiceProvider;
use Omnipay\Common\GatewayFactory;

class PolishPaymentsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->publishes([
            __DIR__.'../../config/polish-payments.php' => config_path('polish-payments.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__.'../../config/polish-payments.php', 'polish-payments'
        );
        $this->app->singleton(GatewayManager::class, function ($app) {
            return new GatewayManager($app, new GatewayFactory, new LaravelHttpClient);
        });
    }
}