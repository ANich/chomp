<?php

namespace ANich\Chomp\ResponseFormatter;

use Psr\Http\Message\ResponseInterface;

class JsonResponseFormatter implements ResponseFormatter
{
    /**
     * Formats an HttpResponse body to an array of key-value pairs.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array
     */
    public function formatToArray(ResponseInterface $response)
    {
        return json_decode($response->getBody(), true);
    }
}
