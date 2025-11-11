<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Mockery;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        // Habilitar mocks de clases y métodos inexistentes
        Mockery::getConfiguration()->allowMockingNonExistentMethods(true);

    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
