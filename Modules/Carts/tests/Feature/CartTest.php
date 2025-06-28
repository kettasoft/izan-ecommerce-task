<?php

namespace Modules\Carts\Tests\Feature;

use Tests\TestCase;
use Modules\Carts\Models\Cart;
use Modules\Cart\Models\CartItem;
use Modules\Users\Models\Customer;
use Modules\Products\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected Customer $user;
    protected Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = Customer::factory()->create();
        $this->product = Product::factory()->create([
            'price' => 100,
        ]);
    }

    /** @test */
    public function it_lists_cart_items_for_authenticated_user()
    {
        Cart::factory()->create([
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
            'quantity' => 2,
        ]);

        $response = $this->actingAs($this->user)->getJson(route('api.carts.index'));

        $response->assertOk()
            ->assertJsonFragment([
                'product_id' => $this->product->id,
                'quantity' => 2,
            ]);
    }

    /** @test */
    public function it_adds_product_to_cart_or_increments_quantity()
    {
        $response = $this->actingAs($this->user)->postJson(route('api.carts.store'), [
            'product_id' => $this->product->id,
            'quantity' => 1,
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['product_id' => $this->product->id]);

        $this->assertDatabaseHas('cart_items', [
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
            'quantity' => 1,
        ]);
    }

    /** @test */
    public function it_removes_item_from_cart()
    {
        $item = Cart::factory()->create([
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
        ]);

        $response = $this->actingAs($this->user)->deleteJson(route('api.carts.destroy', $item->id));

        $response->assertStatus(204);

        $this->assertDatabaseMissing('cart_items', ['id' => $item->id]);
    }

    /** @test */
    public function it_requires_authentication()
    {
        $response = $this->getJson(route('api.carts.index'));
        $response->assertStatus(401);
    }
}
