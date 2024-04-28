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
            'title'        => "Task Title - " . fake()->numberBetween(1, 100),
            'description'  => fake()->realTextBetween(80, 255, 1),
            'due_date'     => fake()->dateTimeBetween('-7 days', '+7 days'),
            'start_date'   => fake()->dateTimeBetween('-7 days', '-1 days'),
            'completed_at' => fake()->dateTimeBetween('+1 days', '+14 days'),
            'status'       => fake()->randomElement(['todo', 'in_progress', 'done']),
            'priority'     => fake()->randomElement(['low', 'medium', 'high']),
        ];
    }
}
