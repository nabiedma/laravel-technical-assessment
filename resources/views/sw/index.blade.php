<x-layouts.app :title="__('Star Wars API')">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Star Wars API') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-4">Star Wars API</h2>
            @livewire('star-wars-search')
        </div>
    </div>
</x-layouts.app>