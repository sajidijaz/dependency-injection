<?php

namespace Services;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private array $configurations = ['verify' => false];

    /**
     * @param string $endpoint
     * @param array $payload
     * @param array $headers
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function post(string $endpoint, array $payload, array $headers = []): ResponseInterface
    {
        $client = new GuzzleClient($this->configurations);
        $options = [
            'json' => $payload,
            'headers' => $headers
        ];
        return $client->post($endpoint, $options);
    }
}
