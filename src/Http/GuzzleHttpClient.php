<?php

namespace ANich\Chomp\Http;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

class GuzzleHttpClient implements HttpClient
{
    protected $guzzle;

    public function __construct()
    {
        $this->guzzle = new GuzzleClient();
    }

    /**
     * Send Get Request.
     *
     * @param $uri
     * @param array $options
     *
     * @return ResponseInterface
     */
    public function get($uri, array $options = [])
    {
        try {
            return $this->guzzle->get($uri);
        } catch (ClientException $e) {
            return;
        }
    }
}
