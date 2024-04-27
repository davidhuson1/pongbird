<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matches>
 */
class MatchesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'opponent_a' => 11,
            'opponent_b' => User::all()->random()->id,
            'score_opponent_a' => $this->faker->randomNumber(2, false),
            'score_opponent_b' => $this->faker->randomNumber(2, false),
            'winner' => $this->faker->randomElement(['opponent_a', 'opponent_b', 'tie'])
        ];
    }
}
