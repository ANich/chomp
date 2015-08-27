<?php

namespace ANich\Chomp;

use ANich\Chomp\Http\GuzzleHttpClient;
use ANich\Chomp\Http\HttpClient;

class Chomp
{
    protected $client;

    public function __construct(HttpClient $client = null)
    {
        $this->client = is_null($client) ? $this->getDefaultHttpClient() : $client;
    }

    public function getDefaultHttpClient()
    {
        return new GuzzleHttpClient();
    }

    public function get($pathToResource, $resourceIdentifier)
    {
        if ($this->isResource($pathToResource)) {
            return $this->getResource($pathToResource, $resourceIdentifier);
        }

        return;
    }

    public function isResource($resourceName)
    {
        if (class_exists($resourceName)) {
            return in_array('ANich\Chomp\Resource', class_parents($resourceName));
        }

        return false;
    }

    public function getResource($className, $identifier)
    {
        $resource = new $className($this->client, $identifier);

        return $resource;
    }
}
