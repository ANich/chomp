<?php

namespace ANich\Chomp\tests;

use ANich\Chomp\ResponseFormatter\ResponseFormatterFactory;
use PHPUnit_Framework_TestCase as PHPUnit;

class ResponseFormatterFactoryTest extends PHPUnit
{
    public function testFactoryCanCreateJsonFormatter()
    {
        $formatter = ResponseFormatterFactory::fromContentType('application/json');
        $this->assertInstanceOf('\\ANich\\Chomp\\ResponseFormatter\\JsonResponseFormatter', $formatter);
    }

    public function testFactoryThrowsExceptionWithInvalidContentType()
    {
        $this->setExpectedException('\\ANich\\Chomp\\Exceptions\\FormatterNotFoundException');
        $formatter = ResponseFormatterFactory::fromContentType('invalidContentType');
    }
}
