<?php

namespace ANich\Chomp\tests;

use ANich\Chomp\ResponseFormatter\JsonResponseFormatter;
use PHPUnit_Framework_TestCase as PHPUnit;
use Mockery as m;

class JsonResponseFormatterTest extends PHPUnit
{
    protected $formatter;
    protected $response;

    public function setUp()
    {
        $this->formatter = new JsonResponseFormatter();
        $this->response = m::mock('Psr\Http\Message\ResponseInterface');
    }

    public function testFormatter()
    {
        $json = '{
          "userId": 1,
          "id": 1,
          "title": "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
          "body": "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
        }';
        $this->response->shouldReceive('getBody')->andReturn($json);
        $result = $this->formatter->formatToArray($this->response);
        $expected = [
            'userId' => 1,
            'id' => 1,
            'title' => 'sunt aut facere repellat provident occaecati excepturi optio reprehenderit',
            'body' => "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto",
        ];
        $this->assertEquals($expected, $result);
    }
}
