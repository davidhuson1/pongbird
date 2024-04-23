<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'opponent_1' => User::all()->random()->id,
            'opponent_2' => User::all()->random()->id,
            'score_opponent_1' => $this->faker->randomNumber(2, false),
            'score_opponent_2' => $this->faker->randomNumber(2, false),
            'winner' => $this->faker->randomElement(['opponent_1', 'opponent_2'])
        ];
    }
}
