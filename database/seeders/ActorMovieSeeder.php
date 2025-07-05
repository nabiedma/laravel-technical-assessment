<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActorMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actors = Actor::factory(5)->create();

        $actors->each(function ($actor) {
            $movies = Movie::factory(3)->create();
            
            // Attach movies to actor with random roles
            $movies->each(function ($movie) use ($actor) {
                $actor->movies()->attach($movie->id, [
                    'role' => fake()->randomElement(['Lead', 'Supporting', 'Cameo', 'Background', 'Recurring']),
                ]);
            });
        });
    }
}
