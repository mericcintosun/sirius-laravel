<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create test users
        User::create([
            'name' => 'Admin',
            'email' => 'adminuser@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Test',
            'email' => 'testuser@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Meric',
            'email' => 'meric@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Batın',
            'email' => 'batin@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Create additional random users
        User::factory(6)->create();
    }
}
