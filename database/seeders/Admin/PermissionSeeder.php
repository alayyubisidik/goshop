<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['id' => '1', 'name' => 'Manage KYC', 'guard_name' => 'admin', 'group_name' => 'KYC Management' ],
            ['id' => '2', 'name' => 'Role Management', 'guard_name' => 'admin', 'group_name' => 'Access Management'],
            ['id' => '3', 'name' => 'Role User Management', 'guard_name' => 'admin', 'group_name' => 'Access Management'],
            ['id' => '4', 'name' => 'Category Management', 'guard_name' => 'admin', 'group_name' => 'Category Management'],
            ['id' => '5', 'name' => 'Tag Management', 'guard_name' => 'admin', 'group_name' => 'Tag Management'],
            ['id' => '6', 'name' => 'Brand Management', 'guard_name' => 'admin', 'group_name' => 'Brand Management'],
            ['id' => '7', 'name' => 'Product Management', 'guard_name' => 'admin', 'group_name' => 'Products Management'],
            ['id' => '8', 'name' => 'View KYC', 'guard_name' => 'admin', 'group_name' => 'KYC Management' ],
            ['id' => '9', 'name' => 'Delete Role', 'guard_name' => 'admin', 'group_name' => 'Access Management' ],
        ];

        DB::table("permissions")->insert($permissions);
    }
}

