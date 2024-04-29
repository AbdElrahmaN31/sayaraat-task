<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->firstName,
            'last_name'  => fake()->lastName,
            'email'      => fake()->unique()->safeEmail(),
            'phone'      => "2010" . fake()->numberBetween(1000000000, 9999999999),
            'password'   => 'Aa@123456',
        ];
    }

    public function employee($data = []): Factory|UserFactory
    {
        return $this->state(fn(array $attributes) => [
            'salary' => floatval(fake()->numberBetween(5, 10) * 10),
            'role'   => 'employee',
        ]);
    }

    public function manager($data = []): Factory|UserFactory
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'manager',
        ]);
    }
}
