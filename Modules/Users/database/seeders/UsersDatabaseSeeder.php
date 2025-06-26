<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Users\Models\Admin;
use Illuminate\Support\Facades\DB;
use Modules\Users\Models\Customer;
use Illuminate\Support\Facades\Schema;

class UsersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        $root = Admin::firstOrCreate([
            'email' => 'root@demo.com',
        ], Admin::factory()->raw([
            'name'             => 'Ibrahim',
            'email'            => 'root@demo.com',
            'phone'            => '01156382044',
        ]));

        // $root->addRole('super_admin');

        // $root->setVerified();

        $admin = Admin::firstOrCreate([
            'email' => 'admin@demo.com',
        ], Admin::factory()->raw([
            'name'             => 'Ahmed',
            'email'            => 'admin@demo.com',
            'phone'            => '987654123',
        ]));

        // $admin->addRole('super_admin');

        // $admin->setVerified();

        $customer = Customer::firstOrCreate([
            'email' => 'customer@demo.com',
        ], Customer::factory()->raw([
            'name'             => 'Customer',
            'email'            => 'customer@demo.com',
            'phone'            => '01552416535',
        ]));

        // $customer->setVerified();
    }
}
