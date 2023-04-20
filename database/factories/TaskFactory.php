<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => fake()->catchPhrase(),
            "description" => fake()->realText($maxNbChars = 200, $indexSize = 2),
			"due_date" => fake()->dateTime(),
			"created_at" => fake()->dateTime()
        ];
    }
}
