@props([
    'actions' => null,
    'heading',
])

<header {{ $attributes->class('w-full bg-white shadow flex items-start justify-between max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8', 'filament-header') }}>
    <x-filament::header.heading>
        {{ $heading }}
    </x-filament::header.heading>

    <x-filament::pages.actions :actions="$actions" class="shrink-0" />
</header>

