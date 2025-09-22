<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductsControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_guest_can_view_products()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_admin_can_create_product()
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post(route('products.store'), [
            'name' => 'Test Product',
            'price' => 1.234,
            'quantity_available' => 10,
        ]);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
    }

    public function test_user_cannot_create_product()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('products.store'), [
            'name' => 'Test Product',
            'price' => 1.234,
            'quantity_available' => 10,
        ]);

        $response->assertStatus(403);
    }

    public function test_purchase_reduces_quantity()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['quantity_available' => 10]);

        $response = $this->actingAs($user)->post(route('products.purchase', $product), [
            'quantity' => 3,
        ]);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'quantity_available' => 7,
        ]);
    }

    public function test_cannot_purchase_more_than_available()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['quantity_available' => 5]);

        $response = $this->actingAs($user)->post(route('products.purchase', $product), [
            'quantity' => 10,
        ]);

        $response->assertSessionHasErrors('quantity');
    }
}
