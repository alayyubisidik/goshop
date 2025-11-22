<?php

namespace Database\Seeders\Admin;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('categories')->insert([
            [
                'id' => 1,
                'parent_id' => null,
                'name' => 'Electronic',
                'slug' => 'electronic',
                'position' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'parent_id' => 1,
                'name' => 'Laptop',
                'slug' => 'laptop',
                'position' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'parent_id' => 1,
                'name' => 'Handphone',
                'slug' => 'handphone',
                'position' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'parent_id' => 2,
                'name' => 'Bussiness Laptop',
                'slug' => 'bussiness-laptop',
                'position' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'parent_id' => 2,
                'name' => 'Gaming Laptop',
                'slug' => 'gaming-laptop',
                'position' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'parent_id' => 3,
                'name' => 'Iphone',
                'slug' => 'iphone',
                'position' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 7,
                'parent_id' => 3,
                'name' => 'Android',
                'slug' => 'android',
                'position' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
