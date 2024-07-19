<?php

namespace Database\Factories;

use App\Models\Subject;
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
        $ids = Subject::pluck('SubjectId')->toArray();
        return [
            'SubjectId' => $this->faker->randomElement($ids),
            'Deadline' => $this->faker->dateTimeBetween("2024-06-30", "2025-12-31")->format("Y-m-d H:i:s"),
            'Title' => $this->faker->sentence(),
            'Image' => $this->faker->imageUrl(),
            'Description' => $this->faker->paragraph(),
        ];
    }
}
