<?php

namespace Factory;

use DTO\ShippingRecipient;

class ShippingRequestFactory
{
    public static function createFromShippingRecipient(ShippingRecipient $shippingRecipient): array
    {
         return [
             "recipient" => [
                 "address1" => $shippingRecipient->getAddress(),
                 "city" => $shippingRecipient->getCity(),
                 "country_code" => $shippingRecipient->getCountryCode(),
                 "state_code" => $shippingRecipient->getStateCode(),
                 "zip" => $shippingRecipient->getZipCode(),
             ],
             "items" => $shippingRecipient->getItems()
         ];
    }
}
