<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Http\Livewire\StarWarsSearch;

beforeEach(function () {
    Cache::flush();
});

test('the star wars search component is rendered', function () {
    Livewire::test(StarWarsSearch::class)
        ->assertSee('Search Star Wars Characters by their name')
        ->assertSee('Search')
        ->assertViewIs('livewire.star-wars-search');
});

test('can search for star wars characters', function () {
    $mockResponse = [
        'results' => [
            [
                'name' => 'Luke Skywalker',
                'height' => '172',
                'mass' => '77',
                'hair_color' => 'blond',
                'eye_color' => 'blue',
                'birth_year' => '19BBY',
                'gender' => 'male'
            ],
            [
                'name' => 'Leia Organa',
                'height' => '150',
                'mass' => '49',
                'hair_color' => 'brown',
                'eye_color' => 'brown',
                'birth_year' => '19BBY',
                'gender' => 'female'
            ]
        ]
    ];

    Http::fake([
        'swapi.dev/api/people/*' => Http::response($mockResponse, 200)
    ]);

    Livewire::test(StarWarsSearch::class)
        ->set('search', 'Luke')
        ->call('searchPeople')
        ->assertSet('characters', $mockResponse['results'])
        ->assertSee('Luke Skywalker')
        ->assertSee('Leia Organa')
        ->assertSee('Search Results (2 found)')
        ->assertSet('isLoading', false)
        ->assertSet('error', '');
});

test('shows loading state during search', function () {
    Http::fake([
        'swapi.dev/api/people/*' => Http::response(['results' => []], 200)
    ]);

    $component = Livewire::test(StarWarsSearch::class)
        ->set('search', 'Luke');

    $component->assertSet('isLoading', false);

    $component->call('searchPeople')
        ->assertSet('isLoading', false);
});

test('handles empty search query', function () {
    Livewire::test(StarWarsSearch::class)
        ->set('search', '')
        ->call('searchPeople')
        ->assertSet('characters', [])
        ->assertSet('error', '');
});

test('displays no results message when no characters found', function () {
    Http::fake([
        'swapi.dev/api/people/*' => Http::response(['results' => []], 200)
    ]);

    Livewire::test(StarWarsSearch::class)
        ->set('search', 'Michael Jordan')
        ->call('searchPeople')
        ->assertSet('characters', [])
        ->assertSee('No characters found for')
        ->assertSee('Michael Jordan');
});

test('handles api errors gracefully', function () {
    Http::fake([
        'swapi.dev/api/people/*' => Http::response('Server Error', 500)
    ]);

    Livewire::test(StarWarsSearch::class)
        ->set('search', 'Luke')
        ->call('searchPeople')
        ->assertSet('characters', [])
        ->assertSet('error', 'Failed to fetch people from the API. Please try again. Error: API request failed')
        ->assertSee('Failed to fetch people from the API. Please try again.');
});

test('caches api responses correctly', function () {
    $mockResponse = [
        'results' => [
            [
                'name' => 'Luke Skywalker',
                'height' => '172',
                'mass' => '77',
                'hair_color' => 'blond',
                'eye_color' => 'blue',
                'birth_year' => '19BBY',
                'gender' => 'male'
            ]
        ]
    ];

    Http::fake([
        'swapi.dev/api/people/*' => Http::response($mockResponse, 200)
    ]);

    Livewire::test(StarWarsSearch::class)
        ->set('search', 'Luke')
        ->call('searchPeople')
        ->assertSet('characters', $mockResponse['results']);

    Http::assertSent(function ($request) {
        return $request->url() === 'http://swapi.dev/api/people/?search=Luke';
    });

    // Clear the HTTP fake to ensure no more calls are made
    Http::fake([]);

    Livewire::test(StarWarsSearch::class)
        ->set('search', 'Luke')
        ->call('searchPeople')
        ->assertSet('characters', $mockResponse['results']);

    Http::assertNothingSent();
});