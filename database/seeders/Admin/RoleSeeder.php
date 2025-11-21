<?php

namespace Database\Seeders\Admin;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'admin'
        ]);

        // Create user
        $admin = Admin::firstOrCreate(
            ['email' => 'admin@gmail.com'], // Jika seeder dijalankan ulang, tidak duplikat
            [
                'name' => 'Admin',
                'password' => bcrypt('test'),
            ]
        );

        // Assign role
        $admin->assignRole('Super Admin');
    }
}
