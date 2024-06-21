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
    public function definition(): array
    {
        return [
            'Deadline' => $this->faker->dateTimeBetween("2024-06-30", "2025-12-31")->format("Y-m-d H:i:s"),
            'Title' => $this->faker->sentence(),
            'Subject' => $this->faker->word(),
            'Image' => $this->faker->imageUrl(),
            'Description' => $this->faker->paragraph(),
        ];
    }
}
