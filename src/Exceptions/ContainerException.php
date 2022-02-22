<?php


namespace Exceptions;

use Exception;
use interfaces\ContainerExceptionInterface;

class ContainerException extends Exception implements ContainerExceptionInterface
{
    private const ERROR_MESSAGE = 'Error while retrieving the entry: %s.';

    public function __construct(string $id)
    {
        parent::__construct(
            sprintf(self::ERROR_MESSAGE, $id)
        );
    }
}