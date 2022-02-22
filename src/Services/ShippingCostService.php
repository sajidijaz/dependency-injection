<?php

declare(strict_types=1);

namespace Services;

use Exceptions\ShippingApiFailedException;
use interfaces\CacheInterface;

class ShippingCostService
{
    private CacheInterface $cacheService;
    private ShippingCostApiService $shippingCostApiService;

    public function __construct(CacheInterface $cacheService, ShippingCostApiService $shippingCostApiService)
    {
        $this->cacheService = $cacheService;
        $this->shippingCostApiService = $shippingCostApiService;
    }

    public function getShippingCost(array $requestData): array
    {
        $shippingRates = $this->cacheService->get('shipping_rates');
        if($shippingRates) {
            return $shippingRates;
        }
        try {
            $shippingRates = $this->shippingCostApiService->getShippingCostFromApi($requestData);
        } catch (ShippingApiFailedException $e) {
            return [];
        }
        $this->cacheService->set('shipping_rates', $shippingRates, 60 * 5);
        return $shippingRates;
    }

}
