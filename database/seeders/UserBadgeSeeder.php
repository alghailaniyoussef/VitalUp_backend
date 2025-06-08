<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Badge;
use App\Models\UserBadge;
use Illuminate\Database\Seeder;

class UserBadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users and badges
        $users = User::all();
        $badges = Badge::all();

        // For each user, assign 1-5 random badges
        foreach ($users as $user) {
            // Skip the first user (admin) to create a specific badge assignment pattern
            if ($user->id === 1) {
                // Admin gets all badges
                foreach ($badges as $badge) {
                    UserBadge::create([
                        'user_id' => $user->id,
                        'badge_id' => $badge->id,
                        'earned_at' => now()->subDays(rand(1, 30)),
                    ]);
                }
                continue;
            }

            // For regular users, assign random badges based on their level
            $badgeCount = min(ceil($user->level / 2), 5); // Higher level users get more badges
            $randomBadges = $badges->random(max(1, $badgeCount));

            foreach ($randomBadges as $badge) {
                UserBadge::create([
                    'user_id' => $user->id,
                    'badge_id' => $badge->id,
                    'earned_at' => now()->subDays(rand(1, 60)),
                ]);
            }
        }
    }
}
