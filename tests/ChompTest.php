<?php

namespace ANich\Chomp\tests;

use ANich\Chomp\Chomp;
use PHPUnit_Framework_TestCase as PHPUnit;

class ChompTest extends PHPUnit
{
    protected $chomp;

    public function setUp()
    {
        $this->chomp = new Chomp();
    }

    public function testChompCanTestIfValidResource()
    {
        $isValidResource = $this->chomp->isResource('\ANich\Chomp\Tests\TestResource');
        $this->assertTrue($isValidResource);
    }

    public function testChompCanCreateResource()
    {
        $resource = $this->chomp->getResource('\ANich\Chomp\Tests\TestResource', '1');
        $this->assertInstanceOf('\ANich\Chomp\Tests\TestResource', $resource);
    }
}
