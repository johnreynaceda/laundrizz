<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 'superadmin',
            'email_verified_at' => now(),
            'is_approved' => true,
        ]);
        // User::create([
        //     'name' => 'administrator',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('password'),
        //     'user_type' => 'admin',
        // ]);
        // User::create([
        //     'name' => 'staff',
        //     'email' => 'staff@gmail.com',
        //     'password' => bcrypt('password'),
        //     'user_type' => 'staff',
        // ]);
        // User::create([
        //     'name' => 'customer',
        //     'email' => 'customer@gmail.com',
        //     'password' => bcrypt('password'),
        //     'user_type' => 'customer',
        //     'email_verified_at' => now()
        // ]);
    }
}
