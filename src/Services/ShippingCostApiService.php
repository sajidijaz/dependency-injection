<?php

declare(strict_types=1);

namespace Services;

use Exceptions\ShippingApiFailedException;
use Throwable;

class ShippingCostApiService
{
    private const API_URL = 'https://api.printful.com';
    private const API_KEY = '77qn9aax-qrrm-idki:lnh0-fm2nhmp0yca7';

    private array $headers;
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->headers = ['Authorization' => ['Basic ' . base64_encode(self::API_KEY)]];
    }

    public function getShippingCostFromApi(array $requestData): array
    {
        try {
            $response = $this->client->post(self::API_URL . '/shipping/rates', $requestData, $this->headers);
        } catch (Throwable $throwable) {
            throw new ShippingApiFailedException($throwable->getMessage());
        }
        if ($response->getStatusCode() === 200) {
            return json_decode((string)$response->getBody(),true);
        }
        throw new ShippingApiFailedException('Failed to get data, error code: ' . $response->getStatusCode());
    }
}
