<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Challenge;
use App\Models\UserChallenge;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserChallengeFactory extends Factory
{
    protected $model = UserChallenge::class;

    public function definition(): array
    {
        $statuses = ['active', 'completed', 'abandoned'];
        $status = $this->faker->randomElement($statuses);
        $startedAt = $this->faker->dateTimeBetween('-60 days', '-1 day');
        $completedAt = null;

        if ($status === 'completed') {
            $completedAt = $this->faker->dateTimeBetween($startedAt, 'now');
        } elseif ($status === 'abandoned') {
            $completedAt = null;
        }

        return [
            'user_id' => User::factory(),
            'challenge_id' => Challenge::factory(),
            'progress' => [], // Will be populated in the configure method
            'status' => $status,
            'started_at' => $startedAt,
            'completed_at' => $completedAt,
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (UserChallenge $userChallenge) {
            // If challenge_id is already set and the challenge exists, use it
            if ($userChallenge->challenge_id && $challenge = Challenge::find($userChallenge->challenge_id)) {
                $goals = $challenge->goals;
                $progress = [];

                foreach ($goals as $index => $goal) {
                    $target = $goal['target'] ?? 1;

                    if ($userChallenge->status === 'completed') {
                        // If completed, progress meets or exceeds all targets
                        $progress[$index] = $target + $this->faker->numberBetween(0, 2);
                    } elseif ($userChallenge->status === 'active') {
                        // If active, progress is between 0 and target
                        $progress[$index] = $this->faker->numberBetween(0, $target);
                    } else {
                        // If abandoned, progress is lower
                        $progress[$index] = $this->faker->numberBetween(0, $target / 2);
                    }
                }

                $userChallenge->progress = $progress;
            }
        });
    }
}
