<?php

namespace ANich\Chomp\ResponseFormatter;

use ANich\Chomp\Exceptions\FormatterNotFoundException;

class ResponseFormatterFactory
{
    public static function fromContentType($contentType)
    {
        $formatters = [
            'application/json' => '\\ANich\\Chomp\\ResponseFormatter\\JsonResponseFormatter',
        ];

        if (isset($formatters[$contentType])) {
            return static::create($formatters[$contentType]);
        }
        throw new FormatterNotFoundException('Formatter not found');
    }

    public static function create($formatter)
    {
        if (class_exists($formatter)) {
            return new $formatter();
        }

        return;
    }
}
