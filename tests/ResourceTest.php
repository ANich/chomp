<?php

namespace ANich\Chomp\tests;

use Mockery as m;
use PHPUnit_Framework_TestCase as PHPUnit;

class ResourceTest extends PHPUnit
{
    protected $client;

    public function tearDown()
    {
        m::close();
    }

    public function setUp()
    {
        $this->client = m::mock('ANich\Chomp\Http\HttpClient');
        $this->response = m::mock('Psr\Http\Message\ResponseInterface');
    }

    public function testResourceCanBePopulated()
    {
        $this->response->shouldReceive(['getStatusCode' => 200, 'getBody' => '{
          "userId": 1,
          "id": 1,
          "title": "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
          "body": "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
        }', 'getHeader' => ['application/json']]);
        $this->client->shouldReceive('get')->andReturn($this->response);
        $resource = new TestResource($this->client, '1');
        $this->assertEquals($resource->userId, '1');
        $this->assertEquals($resource->title, 'sunt aut facere repellat provident occaecati excepturi optio reprehenderit');
        $this->assertEquals($resource->body, "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto");
    }

    public function testResourceReturnsNullFieldsWithInvalidIdentifier()
    {
        $this->response->shouldReceive('getStatusCode')->andReturn(404);
        $this->client->shouldReceive('get')->andReturn($this->response);
        $resource = new TestResource($this->client, -1);
        $this->assertEquals($resource->body, null);
    }

    public function testResourceCanModifyFields()
    {
        $this->response->shouldReceive(['getStatusCode' => 200, 'getBody' => '{
          "userId": 1,
          "id": 1,
          "title": "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
          "body": "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
        }', 'getHeader' => ['application/json']]);
        $this->client->shouldReceive('get')->andReturn($this->response);
        $resource = new TestResource($this->client, '1');
        $this->assertEquals($resource->id, 'ID: 1');
    }
}
