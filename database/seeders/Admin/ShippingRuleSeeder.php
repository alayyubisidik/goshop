<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shipping_rules')->insert([
            [
                'name'    => 'standard',
                'type' => 'flat_amount',
                'minimum_amount' => 10,
                'charge'      => 10,
                'is_active'    => 1,
            ],
            [
                'name'    => 'express',
                'type' => 'flat_amount',
                'minimum_amount' => 10,
                'charge'      => 100,
                'is_active'    => 1,
            ],
        ]);
    }
}
