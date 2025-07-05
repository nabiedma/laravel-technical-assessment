<?php

namespace App\Livewire;

use App\Models\Actor;
use Livewire\Component;
use Livewire\WithPagination;

class ActorsList extends Component
{
    use WithPagination;

    public string $search = '';
    public int $perPage = 5;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function render()
    {
        $actors = Actor::with(['movies' => function ($query) {
                $query->orderBy('release_date', 'desc');
            }])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate($this->perPage);

        return view('livewire.actors-list', [
            'actors' => $actors
        ]);
    }
}
