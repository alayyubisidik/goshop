<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Admin\TagSeeder;
use Database\Seeders\Admin\RoleSeeder;
use Database\Seeders\Admin\BrandSeeder;
use Database\Seeders\Admin\StoreSeeder;
use Database\Seeders\Frontend\UserSeeder;
use Database\Seeders\Admin\CategorySeeder;
use Database\Seeders\Admin\PermissionSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PermissionSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            StoreSeeder::class,
            BrandSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
