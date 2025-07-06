<div class="space-y-6">
    <div class="dark:bg-zinc-500 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <form wire:submit.prevent="searchPeople" class="space-y-4">
                <div class="flex space-x-3 items-end">
                    <div class="w-full">
                        <flux:input label="Search Star Wars Characters by their name" placeholder="Luke, Darth Vader..." type="text" wire:model="search" />
                    </div>
                    <div>
                        <flux:button type="submit" variant="primary">@if($isLoading)
                            <span class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Searching...
                            </span>
                            @else
                                Search
                            @endif
                        </flux:button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if($error)
        <div class="bg-red-100 border border-red-200 rounded-md p-4">
            <p class="text-red-700">{{ $error }}</p>
        </div>
    @endif

    @if(count($characters) > 0)
        <div class="dark:bg-zinc-500 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-medium dark:text-zinc-200 text-gray-900 mb-4">
                    Search Results ({{ count($characters) }} found)
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($characters as $character)
                        <div class="dark:bg-zinc-600 bg-gray-50 rounded-lg p-4 border">
                            <h4 class="font-semibold dark:text-zinc-200 text-gray-900 mb-2">{{ $character['name'] }}</h4>
                            <div class="text-sm dark:text-zinc-100 text-gray-600 space-y-1">
                                <div><strong>Height:</strong> {{ $character['height'] }} cm</div>
                                <div><strong>Mass:</strong> {{ $character['mass'] }} kg</div>
                                <div><strong>Hair Color:</strong> {{ $character['hair_color'] }}</div>
                                <div><strong>Eye Color:</strong> {{ $character['eye_color'] }}</div>
                                <div><strong>Birth Year:</strong> {{ $character['birth_year'] }}</div>
                                <div><strong>Gender:</strong> {{ $character['gender'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @elseif(!empty($search) && !$isLoading)
        <div class="dark:bg-zinc-500 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-center dark:text-gray-100 text-gray-500">
                No characters found for "{{ $search }}"
            </div>
        </div>
    @endif
</div>