<?php

namespace DH\PolishPayments;

use DH\PolishPayments\Client\LaravelHttpClient;
use Illuminate\Contracts\Foundation\Application;
use Omnipay\Common\GatewayFactory;

class GatewayManager
{
    /**
     * Registered gateways
     * @var array
     */
    protected array $gateways = [];

    /**
     * Current gateway
     * @var string|null
     */
    protected ?string $gateway = null;

    public function __construct(
        protected Application       $app,
        protected GatewayFactory    $factory,
        protected LaravelHttpClient $httpClient,
        protected array             $defaults = []
    )
    {
    }

    public function gateway($class, array $config = [])
    {
        if (!isset($this->gateways[$class])) {
            $gateway = $this->factory->create($class, $this->httpClient, $this->app['request']);
            $gateway->initialize(array_merge($this->getConfig($class), $config));
            $this->gateways[$class] = $gateway;
        }

        return $this->gateways[$class];
    }

    protected function getConfig($name): array
    {
        return array_merge(
            $this->defaults,
            $this->app['config']->get('polish-payments.gateways.' . $name, [])
        );
    }
}