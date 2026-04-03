<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'user_id' => \App\Models\User::factory(),
        'title' => $this->faker->sentence(4),    
        'description' => $this->faker->paragraph(), 
        'status' => $this->faker->randomElement(['pending', 'completed']),
        'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
        'due_date' => $this->faker->dateTimeBetween('now', '+1 month'), 
        ];
    }
}
