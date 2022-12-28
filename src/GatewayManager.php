<?php

namespace DH\PolishPayments;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Str;
use Omnipay\Common\GatewayFactory;
use Omnipay\Common\Http\ClientInterface;

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
        protected Application     $app,
        protected GatewayFactory  $factory,
        protected ClientInterface $httpClient,
        protected array           $defaults = []
    )
    {
    }

    public function gateway($class, array $config = [])
    {
        $gateway = $this->factory->create($class, $this->httpClient, $this->app['request']);
        $name = $gateway->getName();

        if (!isset($this->gateways[$name])) {
            $gateway->initialize(array_merge($this->getConfig($name), $config));
            $this->gateways[$name] = $gateway;
        }

        return $this->gateways[$name];
    }

    protected function getConfig($name): array
    {
        return array_merge(
            $this->defaults,
            $this->app['config']->get('polish-payments.gateways.' . $name, [])
        );
    }
}