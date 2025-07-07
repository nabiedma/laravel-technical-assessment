<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video p-4 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                The Actors Tab will take you to a page to filter actors by their name and see the movies they have worked at.
            </div>
            <div class="relative aspect-video p-4 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                The SW API Tab will take you to a page to search for your favorite Star Wars characters.
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
