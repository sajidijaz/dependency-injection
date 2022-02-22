<?php

namespace Factory;

use Services\Cache;
use Container\Container;
use Services\Client;
use Services\ShippingCostApiService;
use Services\ShippingCostService;

class DependencyFactory
{
    public static function getDependencies(): array
    {
         return [
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
         ];
    }
}
