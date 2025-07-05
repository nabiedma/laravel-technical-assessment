<div class="space-y-6">
    <div class="overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="flex flex-col items-center space-x-4">
                <div class="flex-1 w-full">
                    <flux:input label="Search Actors" placeholder="Search for an actor..." type="text" wire:model.live.debounce.200ms="search" />
                </div>
                <div class="text-sm w-full text-gray-500">
                    <span>
                        {{ $actors->total() }} actor(s) found
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="dark:bg-zinc-500 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            @if($actors->count() > 0)
                <div class="space-y-6">
                    @foreach($actors as $actor)
                        <div class="border-b border-gray-200 pb-6 last:border-b-0">
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold dark:text-zinc-200 text-gray-900">
                                    {{ $actor->name }}
                                </h3>
                                <div class="text-sm dark:text-zinc-100 text-gray-600 mt-1">
                                    @if($actor->birthdate)
                                        Born: {{ $actor->birthdate->format('F j, Y') }}
                                    @endif
                                    @if($actor->nationality)
                                        | {{ $actor->nationality }}
                                    @endif
                                </div>
                                @if($actor->bio)
                                    <p class="text-gray-700 dark:text-gray-200 mt-2 text-sm leading-relaxed">
                                        {{ Str::limit($actor->bio, 150) }}
                                    </p>
                                @endif
                            </div>

                            <div>
                                <h4 class="text-md font-medium dark:text-gray-100 text-gray-800 mb-3">
                                    Movies ({{ $actor->movies->count() }})
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($actor->movies as $movie)
                                        <div class="dark:bg-zinc-600 dark:border-zinc-400 bg-gray-50 rounded-lg p-4 border">
                                            <div class="flex justify-between items-start mb-2">
                                                <h5 class="font-medium dark:text-zinc-100 text-gray-900 text-sm">
                                                    {{ $movie->title }}
                                                </h5>
                                                @if($movie->rating)
                                                    <span class="text-xs dark:bg-blue-200 bg-blue-100 text-blue-800 px-2 py-1 rounded">
                                                        {{ $movie->rating }}/10
                                                    </span>
                                                @endif
                                            </div>
                                            
                                            <div class="text-xs dark:text-zinc-200 text-gray-600 space-y-1">
                                                @if($movie->release_date)
                                                    <div>{{ $movie->release_date->format('Y') }}</div>
                                                @endif
                                                @if($movie->genre)
                                                    <div>{{ $movie->genre }}</div>
                                                @endif
                                                @if($movie->pivot->role)
                                                    <div class="dark:text-indigo-200 text-indigo-600 font-medium">
                                                        Role: {{ $movie->pivot->role }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $actors->links('pagination::tailwind') }}
                </div>
            @else
                <div class="text-center py-8">
                    <div class="dark:text-gray-100 text-gray-500">
                        @if($search)
                            No actors found matching "{{ $search }}"
                        @else
                            No actors found in the database.
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>