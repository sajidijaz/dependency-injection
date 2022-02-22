<?php

require('vendor/autoload.php');

use Container\Container;
use Controllers\HomeController;
use Factory\DependencyFactory;

$di = new Container();
$di->register(DependencyFactory::getDependencies());

echo "<pre>";print_r((new HomeController($this->di->get('ShippingCostService')))->index());

