<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\DrugController;
use Illuminate\Http\Request;
use Mockery;
use Illuminate\View\View;

class DrugControllerTest extends TestCase
{
    public function test_index_returns_view_with_all_drugs()
    {
        $mock = Mockery::mock('alias:App\Models\Drug');
        $mock->shouldReceive('all')->once()->andReturn(['drug1', 'drug2']);

        $request = Request::create('/drugs', 'GET');

        $controller = new DrugController();

        $response = $controller->index($request);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('drug.index', $response->name());
        $this->assertArrayHasKey('viewData', $response->getData());
        $this->assertEquals(['drug1', 'drug2'], $response->getData()['viewData']['drugs']);
    }

    public function test_show_returns_view_with_drug_data()
    {
        $mock = Mockery::mock('alias:App\Models\Drug');
        $mock->shouldReceive('with->findOrFail')
            ->once()
            ->with(1)
            ->andReturn(['id' => 1, 'name' => 'Aspirina']);

        $controller = new DrugController();

        $response = $controller->show(1);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('drug.show', $response->name());
        $this->assertArrayHasKey('viewData', $response->getData());
        $this->assertEquals(['id' => 1, 'name' => 'Aspirina'], $response->getData()['viewData']['drug']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
