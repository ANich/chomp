<?php

namespace ANich\Chomp\tests;

use ANich\Chomp\Resource;

class TestResource extends Resource
{
    protected $baseUri = 'http://jsonplaceholder.typicode.com/posts/';

    public function idModifier($id)
    {
        return 'ID: '.$id;
    }
}
