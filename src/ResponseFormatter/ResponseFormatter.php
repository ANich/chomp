<?php

namespace ANich\Chomp\ResponseFormatter;

use Psr\Http\Message\ResponseInterface;

interface ResponseFormatter
{
    /**
     * Formats an HttpResponse body to an array of key-value pairs.
     *
     * @param ResponseInterface $response
     *
     * @return array
     */
    public function formatToArray(ResponseInterface $response);
}
