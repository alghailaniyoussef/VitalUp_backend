<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks and clear existing users
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create admin user
        User::create([
            'name' => 'VitalUp Admin',
            'email' => 'admin@vitalup.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            'points' => 1000,
            'level' => 5,
            'email_verified_at' => now(),
            'email_frequency' => 'daily',
            'interests' => json_encode(['fitness', 'nutrition', 'mental_health']),
        ]);

        // Create regular users with different interests and email frequencies
        $users = [
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 450,
                'level' => 3,
                'email_verified_at' => now(),
                'email_frequency' => 'daily',
                'interests' => json_encode(['fitness', 'nutrition']),
            ],
            [
                'name' => 'Michael Chen',
                'email' => 'michael.chen@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 320,
                'level' => 2,
                'email_verified_at' => now(),
                'email_frequency' => 'weekly',
                'interests' => json_encode(['mental_health', 'sleep']),
            ],
            [
                'name' => 'Emma Rodriguez',
                'email' => 'emma.rodriguez@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 680,
                'level' => 4,
                'email_verified_at' => now(),
                'email_frequency' => 'daily',
                'interests' => json_encode(['fitness', 'nutrition', 'mental_health']),
            ],
            [
                'name' => 'David Thompson',
                'email' => 'david.thompson@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 150,
                'level' => 1,
                'email_verified_at' => now(),
                'email_frequency' => 'weekly',
                'interests' => json_encode(['sleep', 'stress_management']),
            ],
            [
                'name' => 'Lisa Wang',
                'email' => 'lisa.wang@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 890,
                'level' => 5,
                'email_verified_at' => now(),
                'email_frequency' => 'daily',
                'interests' => json_encode(['fitness', 'nutrition', 'mental_health', 'sleep']),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
