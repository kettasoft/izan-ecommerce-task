<?php

namespace Modules\Categories\Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesDatabaseSeeder extends Seeder
{
    /**
     * The categories to seed.
     *
     * @var array
     */
    protected array $categories = [
        [
            'name' => 'Electronics',
            'slug' => 'electronics',
            'description' => 'All electronic items',
            'parent_id' => null,
            'status' => 'active',
        ],
        [
            'name' => 'Books',
            'slug' => 'books',
            'description' => 'All kinds of books',
            'parent_id' => null,
            'status' => 'active',
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->categories as $category) {
            \Modules\Categories\Models\Category::create($category);
        }
    }
}
