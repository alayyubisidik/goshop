<?php

namespace Database\Seeders\Admin;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            "parent_id" => null,
            "name" => "First Category",
            "slug" => "first-category",
            "position" => "0",
            "is_active" => 1,
            "is_featured" => 0,
        ]);
    }
}
