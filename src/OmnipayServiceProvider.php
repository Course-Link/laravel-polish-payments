<?php

namespace CourseLink\Payments;

use CourseLink\Payments\Http\HttpClient;
use Illuminate\Support\ServiceProvider;
use Omnipay\Common\GatewayFactory;
use Illuminate\Support\Facades\Route;

class OmnipayServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerRoutes();
        $this->registerPublishing();
    }

    public function register(): void
    {
        $this->configure();
        $this->bindGatewayManager();
    }

    protected function configure(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/omnipay.php', 'omnipay'
        );
    }

    protected function bindGatewayManager(): void
    {
        $this->app->singleton(GatewayManager::class, function ($app) {
            return new GatewayManager($app, new GatewayFactory, new HttpClient);
        });
    }

    protected function registerRoutes(): void
    {
        Route::group([
            'prefix' => config('omnipay.path'),
            'as' => 'omnipay.'
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    protected function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/omnipay.php' => $this->app->configPath('omnipay.php'),
            ], 'omnipay-config');
        }
    }
}