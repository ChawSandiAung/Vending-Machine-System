<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_creation()
    {
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 2.500,
            'quantity_available' => 50,
        ]);

        $this->assertEquals('Test Product', $product->name);
        $this->assertEquals(2.500, $product->price);
        $this->assertEquals(50, $product->quantity_available);
    }
}
