<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actor>
 */
class ActorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'nationality' => fake()->randomElement(['American', 'Canadian', 'Argentinean', 'Irish', 'Colombian', 'Spanish', 'French', 'Indian', 'Australian']),
            'birthdate' => fake()->date('Y-m-d', '2010-12-31'),
        ];
    }
}
