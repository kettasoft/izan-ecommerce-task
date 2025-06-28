<?php

namespace Modules\Carts\Database\Factories;

use Modules\Users\Models\Customer;
use Modules\Products\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Carts\Models\Cart::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => Customer::factory()->create()->getKey(),
            'product_id' => Product::factory()->create()->getKey(),
            'quantity' => fake()->numberBetween(1, 10),
        ];
    }
}
