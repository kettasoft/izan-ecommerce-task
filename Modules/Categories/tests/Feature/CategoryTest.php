<?php

namespace Modules\Categories\Tests\Feature;

use Laravel\Sanctum\Sanctum;
use Modules\Categories\Models\Category;
use Modules\Users\Models\Admin;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Test the index method of the CategoryController.
     *
     * @return void
     */
    public function testIndex()
    {
        Sanctum::actingAs(Admin::factory()->create(), ['*']);
        // Create some categories using the factory
        Category::factory()->count(5)->create();

        $response = $this->getJson(route('api.categories.index'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'slug',
                        'description',
                        'parent_id',
                        'status',
                        'created_at',
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
            'name' => 'Test Category',
            'slug' => 'test-category',
            'description' => 'This is a test category.',
            'parent_id' => null,
            'status' => 'active',
        ];
        $response = $this->postJson(route('api.categories.store'), $data);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'slug',
                    'description',
                    'parent_id',
                    'status',
                    'created_at',
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
        $category = Category::factory()->create();
        $response = $this->getJson(route('api.categories.show', $category->id));
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'slug',
                    'description',
                    'parent_id',
                    'status',
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
        $category = Category::factory()->create();
        $data = [
            'name' => 'Updated Category',
            'slug' => 'updated-category',
            'description' => 'This is an updated category.',
            'parent_id' => null,
            'status' => 'inactive',
        ];
        $response = $this->putJson(route('api.categories.update', $category->id), $data);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'slug',
                    'description',
                    'parent_id',
                    'status',
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
        $category = Category::factory()->create();
        $response = $this->deleteJson(route('api.categories.destroy', $category->id));
        $response->assertStatus(204);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    /**
     * Test the unauthorized access to the index method.
     *
     * @return void
     */
    public function testCreateCategoryWithParent()
    {
        Sanctum::actingAs(Admin::factory()->create(), ['*']);
        $parentCategory = Category::factory()->create();

        $data = [
            'name' => 'Child Category',
            'slug' => 'child-category',
            'description' => 'This is a child category.',
            'parent_id' => $parentCategory->id,
            'status' => 'active',
        ];

        $response = $this->postJson(route('api.categories.store'), $data);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'slug',
                    'description',
                    'parent_id',
                    'status',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }
}
