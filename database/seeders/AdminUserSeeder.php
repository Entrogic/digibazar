<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user if doesn't exist
        User::firstOrCreate(
            [
                'email' => 'admin@rajubazar.com'
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@rajubazar.com',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // Create another admin for testing
        User::firstOrCreate(
            [
                'email' => 'superadmin@rajubazar.com'
            ],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@rajubazar.com',
                'password' => Hash::make('superadmin123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // Create a regular user for testing
        User::firstOrCreate(
            [
                'email' => 'user@rajubazar.com'
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@rajubazar.com',
                'password' => Hash::make('user123'),
                'is_admin' => false,
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin users created successfully!');
        $this->command->info('Admin credentials:');
        $this->command->info('Email: admin@rajubazar.com | Password: admin123');
        $this->command->info('Email: superadmin@rajubazar.com | Password: superadmin123');
        $this->command->info('Regular user: user@rajubazar.com | Password: user123');
    }
}
