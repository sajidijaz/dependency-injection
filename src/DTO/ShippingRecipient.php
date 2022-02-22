<?php

namespace DTO;

class ShippingRecipient
{
    private string $address;

    private string $city;

    private string $countryCode;

    private string $stateCode;

    private int $zipCode;

    private array $items;

    public function __construct(
        string $address,
        string $city,
        string $countryCode,
        string $stateCode,
        int $zipCode,
        array $items
    )
    {
        $this->address = $address;
        $this->city = $city;
        $this->countryCode = $countryCode;
        $this->stateCode = $stateCode;
        $this->zipCode = $zipCode;
        $this->items = $items;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getStateCode(): string
    {
        return $this->stateCode;
    }

    public function getZipCode(): int
    {
        return $this->zipCode;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
