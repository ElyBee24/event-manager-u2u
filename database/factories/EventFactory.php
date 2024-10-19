<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text,
            'description' => $this->faker->text,
            'scheduled_at' => $this->faker->dateTimeBetween('now', '+1 year'),
            'location' => $this->faker->address,
            'max_attendees' => $this->faker->numberBetween(1, 100),
        ];
    }
}
