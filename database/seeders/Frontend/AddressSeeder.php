<?php

namespace Database\Seeders\Frontend;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('addresses')->insert([
            [
                'user_id'    => 2,
                'first_name' => 'Rizky',
                'last_name'  => 'Pratama',
                'phone'      => '081234567890',
                'email'      => 'rizky@example.com',
                'address'    => 'Jl. Melati No. 12',
                'city'       => 'Jakarta',
                'state'      => 'DKI Jakarta',
                'country'    => 'Indonesia',
                'zip'        => 11220,
                'is_default' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id'    => 2,
                'first_name' => 'Rizky',
                'last_name'  => 'Pratama',
                'phone'      => '081987654321',
                'email'      => 'rizky.work@example.com',
                'address'    => 'Jl. Anggrek No. 45',
                'city'       => 'Jakarta',
                'state'      => 'DKI Jakarta',
                'country'    => 'Indonesia',
                'zip'        => 11530,
                'is_default' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
