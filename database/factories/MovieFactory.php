<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(2, true),
            'genre' => fake()->randomElement(['Horror', 'Drama', 'Romance', 'Sci-Fi', 'Documentary', 'Crime', 'Comedy', 'Action']),
            'director' => fake()->name(),
            'description' => fake()->paragraph(),
            'release_date' => fake()->dateTimeBetween('-20 years', 'now'),
            'duration' => fake()->numberBetween(85, 150),
            'rating' => fake()->randomFloat(1, 3.0, 10.0),
        ];
    }
}
