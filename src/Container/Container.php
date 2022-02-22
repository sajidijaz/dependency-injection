<?php

declare(strict_types=1);

namespace Container;

use Exceptions\ContainerException;
use Exceptions\ContainerNotFoundException;
use Exceptions\ProviderException;
use interfaces\ContainerInterface;

class Container implements ContainerInterface
{

    private array $provider = [];

    public function register(array $providers): void
    {
        foreach ($providers as $key => $provider) {
            if(!$this->has($key)) {
                $this->provider[$key] = $this->create($provider);
            }
        }
    }

    /**
     * @param string $id
     *
     * @return mixed
     *
     * @throws ContainerNotFoundException
     */
    public function get($id)
    {
        if (!$this->has($id)) {
            throw new ContainerNotFoundException($id);
        }
        return $this->provider[$id];
    }

    public function has($id): bool
    {
        return isset($this->provider[$id]);
    }

    private function create($provider)
    {
        if(is_object($provider) && method_exists($provider, "__invoke")) {
            return call_user_func($provider, $this);
        }

        if (is_object($provider)) {
            return $provider;
        }
        return null;
    }
}