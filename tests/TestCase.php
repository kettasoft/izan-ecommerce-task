<?php

namespace Tests;

use Database\Seeders\DummyDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Run a specific seeder
        $this->seed(DummyDatabaseSeeder::class);
    }

    public function runItemsManagement()
    {
        $this->seed(\Modules\Users\Database\Seeders\UsersDatabaseSeeder::class);
        // $this->seed(\Modules\Products\Database\Seeders\ProductsDatabaseSeeder::class);
        // $this->seed(\Modules\Orders\Database\Seeders\OrdersDatabaseSeeder::class);
    }
}
