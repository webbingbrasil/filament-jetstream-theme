@props([
'actions' => null,
'heading',
])

@php
    $maxWidth = match (config('filament.layout.max_content_width')) {
                        'xl' => 'max-w-xl',
                        '2xl' => 'max-w-2xl',
                        '3xl' => 'max-w-3xl',
                        '4xl' => 'max-w-4xl',
                        '5xl' => 'max-w-5xl',
                        '6xl' => 'max-w-6xl',
                        'full' => 'max-w-full',
                        default => 'max-w-7xl',
                    }
@endphp

<header class="bg-white shadow">
    <div {{ $attributes->class('flex items-start justify-between '.$maxWidth.' mx-auto py-6 px-4 sm:px-6 lg:px-8', 'filament-header') }}>
        <x-filament::header.heading>
            {{ $heading }}
        </x-filament::header.heading>

        <x-filament::pages.actions :actions="$actions" class="shrink-0" />
    </div>
</header>

