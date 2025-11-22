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

        User::create([
            "name" => "Messi",
            "email" => "messi@gmail.com",
            "password" => bcrypt("test"),
            "user_type" => "vendor",
        ]);

        User::create([
            "name" => "Neymar",
            "email" => "neymar@gmail.com",
            "password" => bcrypt("test"),
            "user_type" => "vendor",
        ]);

        User::create([
            "name" => "Ronaldo",
            "email" => "ronaldo@gmail.com",
            "password" => bcrypt("test"),
            "user_type" => "vendor",
        ]);

        User::create([
            "name" => "Mbappe",
            "email" => "mbappe@gmail.com",
            "password" => bcrypt("test"),
            "user_type" => "vendor",
        ]);

        User::create([
            "name" => "Benzema",
            "email" => "benzema@gmail.com",
            "password" => bcrypt("test"),
            "user_type" => "vendor",
        ]);
    }
}
