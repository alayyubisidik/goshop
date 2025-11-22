<?php

namespace Database\Seeders\Admin;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $tags = [
            ['name' => 'Technology'],
            ['name' => 'Gadget'],
            ['name' => 'Laptop'],
            ['name' => 'Smartphone'],
            ['name' => 'Gaming'],
            ['name' => 'Business'],
            ['name' => 'Innovation'],
            ['name' => 'Software'],
            ['name' => 'Hardware'],
            ['name' => 'AI'],
        ];

        foreach ($tags as &$tag) {
            $tag['slug'] = Str::slug($tag['name']);
            $tag['is_active'] = 1;
            $tag['created_at'] = $now;
            $tag['updated_at'] = $now;
        }

        DB::table('tags')->insert($tags);
    }
}
