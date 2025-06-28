<?php

namespace Modules\Products\Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsDatabaseSeeder extends Seeder
{
    /**
     * The products to seed.
     *
     * @var array
     */
    protected array $products = [
        [
            'name' => 'Sample Product',
            'slug' => 'sample-product',
            'description' => 'This is a sample product description.',
            'price' => 19.99,
            'stock' => 100,
            'category_id' => null, // Assuming category_id can be nullable
        ],
        [
            'name' => 'Another Product',
            'slug' => 'another-product',
            'description' => 'This is another product description.',
            'price' => 29.99,
            'stock' => 50,
            'category_id' => null, // Assuming category_id can be nullable
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->products as $product) {
            \Modules\Products\Models\Product::create($product);
        }
    }
}
