<?php

namespace Controllers;

use DTO\ShippingRecipient;
use Exceptions\ContainerException;
use Factory\ShippingRequestFactory;
use Services\ShippingCostService;

class HomeController
{
    private ShippingCostService $shippingCostService;

    public function __construct(ShippingCostService $shippingCostService)
    {
        $this->shippingCostService = $shippingCostService;
    }

    public function index(): array
    {
        $shippingRecipient = new ShippingRecipient(
            "11025 Westlake Dr",
            "Charlotte",
            "US",
            "NC",
            28273,
            [
                [
                    "quantity" => 2,
                    "variant_id" => 7679
                ]
            ]
        );
        try {
            return $this->shippingCostService->getShippingCost(
                ShippingRequestFactory::createFromShippingRecipient($shippingRecipient)
            );
        } catch (ContainerException $e) {
            return [];
        }
    }

}
