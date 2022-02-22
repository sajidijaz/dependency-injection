<?php


namespace Exceptions;


use interfaces\NotFoundExceptionInterface;
use RuntimeException;

class ContainerNotFoundException extends RuntimeException implements NotFoundExceptionInterface
{
    private const ERROR_MESSAGE = 'No entry was found for %s identifier.';

    public function __construct(string $id)
    {
        parent::__construct(
            sprintf(self::ERROR_MESSAGE, $id)
        );
    }
}