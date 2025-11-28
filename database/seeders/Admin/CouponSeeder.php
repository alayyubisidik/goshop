<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coupons')->insert([
            [
                'code'    => 'test-1',
                'value' => '100',
                'is_percent'  => 0,
                'minimum_spend'      => 10,
                'maximum_spend'      => 100000,
                'usage_limit_per_coupon'    => 99999,
                'usage_limit_per_customer'       => 99999,
                'used'      => 0,
                'is_active'    => 1,
                'start_date' => "2025-11-01",
                'end_date' => "2025-11-30",
            ],
        ]);
    }
}
