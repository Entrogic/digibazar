<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Dizi Bazar Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('22222222'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // Create another admin user for testing
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Test Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // Create a regular user for testing
        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Test User',
                'email' => 'user@example.com',
                'password' => Hash::make('user123'),
                'is_admin' => false,
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin users created successfully!');
        $this->command->line('Admin Login Credentials:');
        $this->command->line('Email: admin@rajubazar.com | Password: password123');
        $this->command->line('Email: admin@example.com | Password: admin123');
        $this->command->line('Regular User: user@example.com | Password: user123');
    }
}
