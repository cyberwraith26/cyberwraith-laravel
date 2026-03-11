<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        $admin = User::firstOrCreate(
            ['email' => 'TheCyberWraith@proton.me'],
            [
                'name' => 'CyberWraith Admin',
                'password' => Hash::make('CyberWraith@2026'),
                'role' => 'admin',
                'tier' => 'agency',
            ]
        );

        $admin->update(['role' => 'admin', 'tier' => 'agency']);

        Subscription::firstOrCreate(
            ['user_id' => $admin->id],
            ['tier' => 'agency', 'status' => 'active']
        );

        // Test user
        $user = User::firstOrCreate(
            ['email' => 'bithcker19@proton.me'],
            [
                'name' => 'Bithcker',
                'password' => Hash::make('Bithcker@9169'),
                'role' => 'user',
                'tier' => 'pro',
            ]
        );

        Subscription::firstOrCreate(
            ['user_id' => $user->id],
            ['tier' => 'pro', 'status' => 'trialing']
        );
    }
}
