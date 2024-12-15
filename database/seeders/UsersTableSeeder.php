<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Sample admin user
        DB::table('users')->insert([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Sample agent user
        DB::table('users')->insert([
            'name' => 'Agent Smith',
            'username' => 'agent',
            'email' => 'agent@example.com',
            'password' => Hash::make('agent123'),
            'role' => 'agent',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Sample regular user
        DB::table('users')->insert([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
