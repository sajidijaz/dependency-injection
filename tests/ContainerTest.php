<?php

use Container\Container;
use Exceptions\ContainerException;
use Exceptions\ContainerNotFoundException;
use PHPUnit\Framework\TestCase;
use Services\Cache;
use Services\Client;
use Services\ShippingCostApiService;
use Services\ShippingCostService;

class ContainerTest extends TestCase
{
    private const PROVIDER_NAME = 'my_container';

    /** @var Container */
    private $container;

    protected function setUp(): void
    {
        $this->container = new Container();
    }

    public function testGetExistentContainer(): void
    {
        $this->container->register([
            'Cache' => function (Container $di) {
                return new Cache();
            }
        ]);

        $this->assertInstanceOf(
            Cache::class,
            $this->container->get('Cache')
        );
    }

    public function testGetContainerThatReturnsShippingCostService(): void
    {
        $this->container->register([
            'Cache' => function (Container $di) {
                return new Cache();
            },
            'Client' => function (Container $di) {
                return new Client();
            },
            'ShippingCostApiService' => function (Container $di) {
                return new ShippingCostApiService($di->get('Client'));
            },
            'ShippingCostService' => function (Container $di) {
                return new ShippingCostService($di->get('Cache'), $di->get('ShippingCostApiService'));
            }
        ]);

        $this->assertInstanceOf(
            ShippingCostService::class,
            $this->container->get('ShippingCostService')
        );
    }

    public function testGetNonExistentContainer(): void
    {
        $this->expectException(ContainerNotFoundException::class);
        $this->container->get('idontexist');
    }

}