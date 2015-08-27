<?php

namespace ANich\Chomp\Http;

use Psr\Http\Message\ResponseInterface;

interface HttpClient
{
    /**
     * Send Get Request.
     *
     * @param $uri
     * @param $options
     *
     * @return ResponseInterface
     */
    public function get($uri, array $options = []);
}
