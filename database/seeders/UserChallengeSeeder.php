<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Challenge;
use App\Models\UserChallenge;
use Illuminate\Database\Seeder;

class UserChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users and challenges
        $users = User::all();
        $challenges = Challenge::all();

        // For each user, assign 1-3 random challenges with different statuses
        foreach ($users as $user) {
            // Skip the first user (admin) to create a specific challenge assignment pattern
            if ($user->id === 1) {
                // Admin has completed most challenges
                foreach ($challenges as $index => $challenge) {
                    $status = $index < 8 ? 'completed' : 'active';
                    $startedAt = now()->subDays(rand(10, 60));
                    $completedAt = $status === 'completed' ? $startedAt->copy()->addDays($challenge->duration_days) : null;

                    $progress = [];
                    $goals = is_array($challenge->goals) ? $challenge->goals : (json_decode($challenge->goals, true) ?? []);
                    foreach ($goals as $goalIndex => $goal) {
                        $target = is_array($goal) ? ($goal['target'] ?? 1) : 1;
                        $progress[$goalIndex] = $status === 'completed' ? $target : rand(0, $target - 1);
                    }

                    UserChallenge::create([
                        'user_id' => $user->id,
                        'challenge_id' => $challenge->id,
                        'progress' => $progress,
                        'status' => $status,
                        'started_at' => $startedAt,
                        'completed_at' => $completedAt,
                    ]);
                }
                continue;
            }

            // For regular users, assign random challenges based on their level
            $challengeCount = min(ceil($user->level / 3), 3); // Higher level users get more challenges
            $randomChallenges = $challenges->random(max(1, $challengeCount));

            foreach ($randomChallenges as $index => $challenge) {
                // Determine status based on index (first challenge more likely to be completed)
                $statusOptions = ['active', 'completed', 'abandoned'];
                $statusWeights = $index === 0 ? [30, 60, 10] : [60, 30, 10];
                $status = $this->weightedRandom($statusOptions, $statusWeights);

                $startedAt = now()->subDays(rand(5, 30));
                $completedAt = $status === 'completed' ? $startedAt->copy()->addDays($challenge->duration_days) : null;

                $progress = [];
                $goals = is_array($challenge->goals) ? $challenge->goals : (json_decode($challenge->goals, true) ?? []);
                foreach ($goals as $goalIndex => $goal) {
                    $target = is_array($goal) ? ($goal['target'] ?? 1) : 1;

                    if ($status === 'completed') {
                        $progress[$goalIndex] = $target;
                    } elseif ($status === 'active') {
                        $progress[$goalIndex] = rand(0, $target - 1);
                    } else { // abandoned
                        $progress[$goalIndex] = rand(0, intval($target / 2));
                    }
                }

                UserChallenge::create([
                    'user_id' => $user->id,
                    'challenge_id' => $challenge->id,
                    'progress' => $progress,
                    'status' => $status,
                    'started_at' => $startedAt,
                    'completed_at' => $completedAt,
                ]);
            }
        }
    }

    /**
     * Get a weighted random value from an array.
     *
     * @param array $values The values to choose from
     * @param array $weights The weights for each value
     * @return mixed A randomly selected value
     */
    private function weightedRandom(array $values, array $weights)
    {
        $totalWeight = array_sum($weights);
        $randomNumber = rand(1, $totalWeight);

        $weightSum = 0;
        foreach ($values as $index => $value) {
            $weightSum += $weights[$index];
            if ($randomNumber <= $weightSum) {
                return $value;
            }
        }

        return $values[0]; // Fallback
    }
}
