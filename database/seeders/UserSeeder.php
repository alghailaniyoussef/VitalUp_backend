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
            'locale' => 'en',
            'interests' => json_encode(['fitness', 'nutrition', 'mental_health']),
        ]);

        // English locale users
        $englishUsers = [
            [
                'name' => 'Youssef Alghailani',
                'email' => 'alghailani.youssef@gmail.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 450,
                'level' => 3,
                'email_verified_at' => now(),
                'email_frequency' => 'daily',
                'locale' => 'en',
                'interests' => json_encode(['fitness', 'nutrition']),
            ],
            [
                'name' => 'Sarah Elghaylani',
                'email' => 'selghaylani@gmail.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 320,
                'level' => 2,
                'email_verified_at' => now(),
                'email_frequency' => 'weekly',
                'locale' => 'en',
                'interests' => json_encode(['mental_health', 'sleep']),
            ],
            [
                'name' => 'Hanane Elouahabi',
                'email' => 'hanane.elouahabi8@gmail.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 680,
                'level' => 4,
                'email_verified_at' => now(),
                'email_frequency' => 'daily',
                'locale' => 'en',
                'interests' => json_encode(['fitness', 'nutrition', 'mental_health']),
            ],
            [
                'name' => 'Youssef Growers',
                'email' => 'youssef@growersgo.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 150,
                'level' => 1,
                'email_verified_at' => now(),
                'email_frequency' => 'weekly',
                'locale' => 'en',
                'interests' => json_encode(['sleep', 'stress_management']),
            ],
            [
                'name' => 'Solomon Barragan',
                'email' => 'barraganriverosolomon@gmail.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 890,
                'level' => 5,
                'email_verified_at' => now(),
                'email_frequency' => 'daily',
                'locale' => 'en',
                'interests' => json_encode(['fitness', 'nutrition', 'mental_health', 'sleep']),
            ],
            [
                'name' => 'Miguel Campus',
                'email' => 'miguel.campus11@gmail.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 275,
                'level' => 2,
                'email_verified_at' => now(),
                'email_frequency' => 'weekly',
                'locale' => 'en',
                'interests' => json_encode(['fitness', 'environmental']),
            ],
            [
                'name' => 'Emma Johnson',
                'email' => 'emma.johnson.en@vitalup.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 520,
                'level' => 3,
                'email_verified_at' => now(),
                'email_frequency' => 'daily',
                'locale' => 'en',
                'interests' => json_encode(['mental_health', 'nutrition']),
            ],
            [
                'name' => 'David Wilson',
                'email' => 'david.wilson.en@vitalup.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 380,
                'level' => 2,
                'email_verified_at' => now(),
                'email_frequency' => 'weekly',
                'locale' => 'en',
                'interests' => json_encode(['fitness', 'sleep']),
            ],
            [
                'name' => 'Lisa Chen',
                'email' => 'lisa.chen.en@vitalup.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 750,
                'level' => 4,
                'email_verified_at' => now(),
                'email_frequency' => 'daily',
                'locale' => 'en',
                'interests' => json_encode(['nutrition', 'environmental', 'mental_health']),
            ],
            [
                'name' => 'Michael Thompson',
                'email' => 'michael.thompson.en@vitalup.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 195,
                'level' => 1,
                'email_verified_at' => now(),
                'email_frequency' => 'weekly',
                'locale' => 'en',
                'interests' => json_encode(['stress_management', 'sleep']),
            ],
        ];

        // Spanish locale users
        $spanishUsers = [
            [
                'name' => 'María García',
                'email' => 'maria.garcia.es@vitalup.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 420,
                'level' => 3,
                'email_verified_at' => now(),
                'email_frequency' => 'daily',
                'locale' => 'es',
                'interests' => json_encode(['fitness', 'nutrition']),
            ],
            [
                'name' => 'Carlos Rodríguez',
                'email' => 'carlos.rodriguez.es@vitalup.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 350,
                'level' => 2,
                'email_verified_at' => now(),
                'email_frequency' => 'weekly',
                'locale' => 'es',
                'interests' => json_encode(['mental_health', 'sleep']),
            ],
            [
                'name' => 'Ana López',
                'email' => 'ana.lopez.es@vitalup.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 650,
                'level' => 4,
                'email_verified_at' => now(),
                'email_frequency' => 'daily',
                'locale' => 'es',
                'interests' => json_encode(['fitness', 'nutrition', 'mental_health']),
            ],
            [
                'name' => 'José Martínez',
                'email' => 'jose.martinez.es@vitalup.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 180,
                'level' => 1,
                'email_verified_at' => now(),
                'email_frequency' => 'weekly',
                'locale' => 'es',
                'interests' => json_encode(['sleep', 'stress_management']),
            ],
            [
                'name' => 'Carmen Fernández',
                'email' => 'carmen.fernandez.es@vitalup.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 820,
                'level' => 5,
                'email_verified_at' => now(),
                'email_frequency' => 'daily',
                'locale' => 'es',
                'interests' => json_encode(['fitness', 'nutrition', 'mental_health', 'sleep']),
            ],
            [
                'name' => 'Diego Sánchez',
                'email' => 'diego.sanchez.es@vitalup.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 290,
                'level' => 2,
                'email_verified_at' => now(),
                'email_frequency' => 'weekly',
                'locale' => 'es',
                'interests' => json_encode(['fitness', 'environmental']),
            ],
            [
                'name' => 'Isabel Ruiz',
                'email' => 'isabel.ruiz.es@vitalup.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 540,
                'level' => 3,
                'email_verified_at' => now(),
                'email_frequency' => 'daily',
                'locale' => 'es',
                'interests' => json_encode(['mental_health', 'nutrition']),
            ],
            [
                'name' => 'Roberto Morales',
                'email' => 'roberto.morales.es@vitalup.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 410,
                'level' => 3,
                'email_verified_at' => now(),
                'email_frequency' => 'weekly',
                'locale' => 'es',
                'interests' => json_encode(['fitness', 'sleep']),
            ],
            [
                'name' => 'Lucía Jiménez',
                'email' => 'lucia.jimenez.es@vitalup.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 720,
                'level' => 4,
                'email_verified_at' => now(),
                'email_frequency' => 'daily',
                'locale' => 'es',
                'interests' => json_encode(['nutrition', 'environmental', 'mental_health']),
            ],
            [
                'name' => 'Fernando Torres',
                'email' => 'fernando.torres.es@vitalup.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
                'points' => 220,
                'level' => 1,
                'email_verified_at' => now(),
                'email_frequency' => 'weekly',
                'locale' => 'es',
                'interests' => json_encode(['stress_management', 'sleep']),
            ],
        ];

        // Create all users
        foreach ($englishUsers as $user) {
            User::create($user);
        }

        foreach ($spanishUsers as $user) {
            User::create($user);
        }
    }
}
