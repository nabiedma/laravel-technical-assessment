<?php

use App\Livewire\ActorsList;
use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('actors list component is rendered', function () {
    Livewire::test(ActorsList::class)
        ->assertSee('Search Actors')
        ->assertSee('Search for an actor')
        ->assertViewIs('livewire.actors-list');
});

test('actors list component shows correct actors count', function () {
    Actor::factory()->count(5)->create();
    
    Livewire::test(ActorsList::class)
        ->assertSee('5 actor(s) found');
});

test('actors list component can search actors', function () {
    Actor::factory()->create(['name' => 'Leonardo DiCaprio']);
    Actor::factory()->create(['name' => 'Margot Robbie']);
    
    Livewire::test(ActorsList::class)
        ->set('search', 'Margot')
        ->assertSee('Margot Robbie')
        ->assertDontSee('Leonardo DiCaprio')
        ->assertSee('1 actor(s) found');
});