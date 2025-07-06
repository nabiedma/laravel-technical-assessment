<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class StarWarsSearch extends Component
{
    public string $search = '';
    public array $characters = [];
    public bool $isLoading = false;
    public string $error = '';

    public function render()
    {
        return view('livewire.star-wars-search');
    }

    public function searchPeople(): void
    {
        $this->error = '';
        
        if (empty(trim($this->search))) {
            $this->characters = [];
            return;
        }

        $this->isLoading = true;
        
        try {
            $this->characters = $this->fetchStarWarsCharacters($this->search);
        } catch (\Exception $e) {
            $this->error = "Failed to fetch people from the API. Please try again. Error: $e->getMessage()";
            $this->characters = [];
        } finally {
            $this->isLoading = false;
        }
    }

    private function fetchStarWarsCharacters(string $query): array
    {
        $cacheKey = 'sw_search_' . md5(strtolower($query));
        
        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($query) {
            $response = Http::withOptions([
                'verify' => false,
                'timeout' => 10,
            ])->get('http://swapi.dev/api/people/', [
                'search' => $query
            ]);

            if ($response->successful()) {
                return $response->json()['results'] ?? [];
            }

            throw new Exception('API request failed');
        });
    }
}
