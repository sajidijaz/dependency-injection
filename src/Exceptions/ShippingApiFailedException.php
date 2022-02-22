<?php

namespace Exceptions;

use Exception;

class ShippingApiFailedException extends Exception
{

    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
