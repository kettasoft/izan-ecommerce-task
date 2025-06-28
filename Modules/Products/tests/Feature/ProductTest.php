<?php

namespace Modules\Products\Tests\Feature;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Modules\Users\Models\Admin;
use Modules\Users\Models\Customer;
use Modules\Products\Models\Product;

class ProductTest extends TestCase
{
    /**
     * Test the index method of the CategoryController.
     *
     * @return void
     */
    public function testIndex()
    {
        Sanctum::actingAs(Customer::factory()->create(), ['*']);
        // Create some products using the factory
        Product::factory()->count(5)->create();

        $response = $this->getJson(route('api.products.index'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'slug',
                        'description',
                        'price',
                        'stock',
                        'category_id',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);
    }

    /**
     * Test the store method of the CategoryController.
     *
     * @return void
     */
    public function testStore()
    {
        Sanctum::actingAs(Admin::factory()->create(), ['*']);

        $data = [
            'name' => 'Test Product',
            'slug' => 'test-product',
            'description' => 'This is a test product.',
            'price' => 99.99,
            'stock' => 50,
            'category_id' => null, // Assuming category_id can be nullable
        ];

        $response = $this->postJson(route('api.products.store'), $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'slug',
                    'description',
                    'price',
                    'stock',
                    'category_id',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }
    /**
     * Test the show method of the CategoryController.
     *
     * @return void
     */
    public function testShow()
    {
        Sanctum::actingAs(Admin::factory()->create(), ['*']);
        $category = Product::factory()->create();
        $response = $this->getJson(route('api.products.show', $category->id));
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'slug',
                    'description',
                    'price',
                    'stock',
                    'category_id',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }

    /**
     * Test the update method of the CategoryController.
     *
     * @return void
     */
    public function testUpdate()
    {
        Sanctum::actingAs(Admin::factory()->create(), ['*']);
        $category = Product::factory()->create();
        $data = [
            'name' => 'Updated Product',
            'slug' => 'updated-product',
            'description' => 'This is an updated product.',
            'price' => 89.99,
            'stock' => 30,
            'category_id' => null, // Assuming category_id can be nullable
        ];
        $response = $this->putJson(route('api.products.update', $category->id), $data);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'slug',
                    'description',
                    'price',
                    'stock',
                    'category_id',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }

    /**
     * Test the destroy method of the CategoryController.
     *
     * @return void
     */
    public function testDestroy()
    {
        Sanctum::actingAs(Admin::factory()->create(), ['*']);
        $category = Product::factory()->create();
        $response = $this->deleteJson(route('api.products.destroy', $category->id));
        $response->assertStatus(204);
        $this->assertDatabaseMissing('products', ['id' => $category->id]);
    }
}
