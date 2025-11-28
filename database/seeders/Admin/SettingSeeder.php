<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = array(
            array('id' => '1', 'key' => 'site_name', 'value' => 'Goshop', 'created_at' => '2025-11-28 13:23:10', 'updated_at' => '2025-11-28 13:23:10'),
            array('id' => '2', 'key' => 'site_email', 'value' => 'goshop@gmail.com', 'created_at' => '2025-11-28 13:23:10', 'updated_at' => '2025-11-28 13:23:10'),
            array('id' => '3', 'key' => 'site_phone', 'value' => '0972532532', 'created_at' => '2025-11-28 13:23:10', 'updated_at' => '2025-11-28 13:23:10'),
            array('id' => '4', 'key' => 'site_currency', 'value' => 'USD', 'created_at' => '2025-11-28 13:23:10', 'updated_at' => '2025-11-28 13:23:10'),
            array('id' => '5', 'key' => 'site_currency_icon', 'value' => '$', 'created_at' => '2025-11-28 13:23:10', 'updated_at' => '2025-11-28 13:23:10'),
            array('id' => '6', 'key' => 'admin_commission', 'value' => '10', 'created_at' => '2025-11-28 13:23:15', 'updated_at' => '2025-11-28 13:23:15'),
            array('id' => '7', 'key' => 'stripe_status', 'value' => 'active', 'created_at' => '2025-11-28 13:24:28', 'updated_at' => '2025-11-28 13:24:28'),
            array('id' => '8', 'key' => 'stripe_mode', 'value' => 'sandbox', 'created_at' => '2025-11-28 13:24:28', 'updated_at' => '2025-11-28 13:24:28'),
            array('id' => '9', 'key' => 'stripe_currency', 'value' => 'USD', 'created_at' => '2025-11-28 13:24:28', 'updated_at' => '2025-11-28 13:24:28'),
        );

        DB::table('settings')->insert($settings);
    }
}
