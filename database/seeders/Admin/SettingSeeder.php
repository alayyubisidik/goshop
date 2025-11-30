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
            array('id' => '12', 'key' => 'site_short_description', 'value' => 'Awesome eCommerce store website template', 'created_at' => '2025-11-30 19:07:36', 'updated_at' => '2025-11-30 19:07:36'),
            array('id' => '13', 'key' => 'site_address', 'value' => '233 North Michigan Avenue, Suite 1800, Chicago, IL 60601', 'created_at' => '2025-11-30 19:07:36', 'updated_at' => '2025-11-30 19:07:36'),
            array('id' => '14', 'key' => 'site_copyright', 'value' => '2025, ShopX - HTML Ecommerce Template All rights reserved', 'created_at' => '2025-11-30 19:07:36', 'updated_at' => '2025-11-30 19:07:36'),
            array('id' => '15', 'key' => 'site_hours', 'value' => '10:00 - 18:00, Mon - Sat', 'created_at' => '2025-11-30 19:07:36', 'updated_at' => '2025-11-30 19:07:36'),
            array('id' => '16', 'key' => 'site_logo', 'value' => 'img/site_logo/5b74238e-6fdf-4bac-98c6-0b7981f2972e.svg', 'created_at' => '2025-11-30 19:11:06', 'updated_at' => '2025-11-30 19:11:06'),
            array('id' => '17', 'key' => 'site_favicon', 'value' => 'img/site_favicon/3bc0ace6-b4df-4386-9ed6-9c08722264f7.svg', 'created_at' => '2025-11-30 19:13:45', 'updated_at' => '2025-11-30 19:13:45')
        );


        DB::table('settings')->insert($settings);
    }
}
