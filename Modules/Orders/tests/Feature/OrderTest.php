<?php

namespace Tests\Feature;

use Tests\TestCase;
use Modules\Orders\Models\Order;
use Modules\Users\Models\Customer;
use Modules\Products\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $products;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = Customer::factory()->create();

        $this->products = Product::factory()->count(3)->create();
    }

    /** @test */
    public function guest_cannot_place_order()
    {
        $response = $this->postJson(route('api.orders.store'), []);
        $response->assertStatus(401);
    }

    /** @test */
    public function it_fails_validation_if_items_are_missing()
    {
        $response = $this->actingAs($this->user)
            ->postJson(route('api.orders.store'), []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['items']);
    }
}
