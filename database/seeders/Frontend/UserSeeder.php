<?php

namespace Database\Seeders\Frontend;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            "name" => "Ayyub",
            "email" => "ayyub@gmail.com",
            "password" => bcrypt("test")
        ]);

    }
}
