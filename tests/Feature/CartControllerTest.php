<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Drug;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\DatabaseSeeder;

class CartControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class); // Carga Suppliers y Drugs
    }

    public function test_it_adds_an_item_to_the_cart()
    {
        $drug = Drug::first();

        $response = $this
            ->from('/')
            ->withSession(['cart_item_data' => []])
            ->post(route('cart.add', $drug->getId()), ['quantity' => 2]);

        $this->assertDatabaseHas('items', [
            'drug_id' => $drug->getId(),
            'quantity' => 2,
            'total' => $drug->getPrice() * 2,
        ]);

        $response->assertSessionHas('success', 'Item added to cart');
    }

    public function test_it_fails_if_quantity_exceeds_stock()
    {
        $drug = Drug::first();

        $response = $this
            ->from('/')
            ->withSession(['cart_item_data' => []])
            ->post(route('cart.add', $drug->getId()), [
                'quantity' => $drug->getStock() + 10,
            ]);

        $this->assertDatabaseMissing('items', ['drug_id' => $drug->getId()]);
        $response->assertSessionHas('fail', 'Insufficient stock for the requested quantity.');
    }
}
