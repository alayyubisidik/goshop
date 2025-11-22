<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Apple',
            'Samsung',
            'Sony',
            'Xiaomi',
            'Oppo',
            'Vivo',
            'Asus',
            'Lenovo',
            'HP',
            'Dell',
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert([
                'image' => '/img/defaults/brand.png',
                'name' => $brand,
                'slug' => Str::slug($brand),
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
