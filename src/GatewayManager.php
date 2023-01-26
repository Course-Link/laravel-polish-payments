<?php

namespace CourseLink\Payments;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Manager;
use Illuminate\Support\Str;
use Omnipay\Common\Exception\RuntimeException;
use Omnipay\Common\GatewayFactory;
use Omnipay\Common\Http\ClientInterface;
use InvalidArgumentException;

class GatewayManager extends Manager
{
    public function __construct(
        Container                 $container,
        protected GatewayFactory  $factory,
        protected ClientInterface $httpClient
    )
    {
        parent::__construct($container);
    }

    public function getDefaultDriver()
    {
        return $this->config->get('omnipay.default');
    }

    public function driver($driver = null, array $config = [])
    {
        $driver = $driver ?: $this->getDefaultDriver();

        if (is_null($driver)) {
            throw new InvalidArgumentException(sprintf(
                'Unable to resolve NULL driver for [%s].', static::class
            ));
        }

        if (!isset($this->drivers[$driver])) {
            $this->drivers[$driver] = $this->createDriver($driver, $config);
        }

        return $this->drivers[$driver];
    }

    protected function createDriver($driver, array $config = [])
    {
        try {
            $gateway = $this->factory->create($driver, $this->httpClient, $this->container['request']);
            $name = $gateway->getName();
        } catch (RuntimeException) {
            throw new InvalidArgumentException("Driver [$driver] not supported.");
        }

        if (!isset($this->drivers[$name])) {
            $gateway->initialize(array_merge($this->getConfig($driver), $config));
            $this->drivers[$name] = $gateway;
        }

        return $this->drivers[$name];
    }

    protected function getConfig($name): array
    {
        return $this->config->get('omnipay.gateways.' . $name, []);
    }
}