<?php

namespace ANich\Chomp;

use ANich\Chomp\Http\HttpClient;
use ANich\Chomp\ResponseFormatter\ResponseFormatter;
use ANich\Chomp\ResponseFormatter\ResponseFormatterFactory;

abstract class Resource
{
    protected $httpClient;
    protected $responseFormatter;
    protected $resourceIdentifier;
    protected $baseUri = '';
    protected $contentType = 'application/json';
    protected $fields;

    public function __construct(HttpClient $httpClient, $resourceIdentifier, ResponseFormatter $responseFormatter = null)
    {
        $this->httpClient = $httpClient;
        $this->resourceIdentifier = $resourceIdentifier;
        $this->responseFormatter = is_null($responseFormatter) ? $this->getResponseFormatter() : $responseFormatter;
        $this->initializeData();
    }

    public function getResponseFormatter()
    {
        return ResponseFormatterFactory::fromContentType($this->contentType);
    }

    public function initializeData()
    {
        $response = $this->httpClient->get($this->baseUri.$this->resourceIdentifier);
        $this->populateFields($response);
    }

    public function populateFields($response)
    {
        if ($this->isValidResponse($response)) {
            $this->fields = $this->responseFormatter->formatToArray($response);
        } else {
            $this->fields = [];
        }
    }

    public function isValidResponse($response)
    {
        if (isset($response)) {
            return 200 === $response->getStatusCode() && $this->isCorrectFormat($response);
        }

        return false;
    }

    public function isCorrectFormat($response)
    {
        return false !== strpos($response->getHeader('content-type')[0], $this->contentType);
    }

    public function __get($attribute)
    {
        if (array_key_exists($attribute, $this->fields)) {
            return $this->getField($attribute);
        }

        return;
    }

    public function getField($fieldName)
    {
        if ($this->hasModifier($fieldName)) {
            return $this->modifyField($fieldName);
        }

        return $this->fields[$fieldName];
    }

    public function hasModifier($field)
    {
        $modifier = $field.'Modifier';

        return method_exists($this, $modifier);
    }

    public function modifyField($field)
    {
        $modifier = $field.'Modifier';

        return $this->{$modifier}($this->fields[$field]);
    }
}
