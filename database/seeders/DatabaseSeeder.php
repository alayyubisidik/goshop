<?php

namespace Database\Seeders;

use App\Models\ShippingRule;
use Illuminate\Database\Seeder;
use Database\Seeders\Admin\TagSeeder;
use Database\Seeders\Admin\RoleSeeder;
use Database\Seeders\Admin\BrandSeeder;
use Database\Seeders\Admin\StoreSeeder;
use Database\Seeders\Frontend\UserSeeder;
use Database\Seeders\Admin\CategorySeeder;
use Database\Seeders\Admin\CouponSeeder;
use Database\Seeders\Admin\PermissionSeeder;
use Database\Seeders\Admin\ProductSeeder;
use Database\Seeders\Admin\SettingSeeder;
use Database\Seeders\Admin\ShippingRuleSeeder;
use Database\Seeders\Frontend\AddressSeeder;
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
            ProductSeeder::class,
            AddressSeeder::class,
            CouponSeeder::class,
            ShippingRuleSeeder::class,
            SettingSeeder::class
        ]);
    }
}
