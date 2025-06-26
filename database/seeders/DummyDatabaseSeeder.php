<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            \Modules\Users\Database\Seeders\UsersDatabaseSeeder::class,
            // \Modules\Products\Database\Seeders\ProductsDatabaseSeeder::class,
            // \Modules\Orders\Database\Seeders\OrdersDatabaseSeeder::class,
        ]);
    }
}
