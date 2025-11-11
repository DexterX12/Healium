<?php

namespace Tests\Feature;

use Tests\TestCase;
use Mockery;

class ExampleTest extends TestCase
{
    public function test_mockery_alias_works()
    {
        $mock = Mockery::mock('alias:App\Models\Drug');
        $mock->shouldReceive('all')->andReturn(['mocked']);

        $this->assertEquals(['mocked'], \App\Models\Drug::all());
    }
}
