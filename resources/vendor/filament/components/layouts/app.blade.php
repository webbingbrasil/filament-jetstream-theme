@props([
    'maxContentWidth' => null,
])

<x-filament::layouts.base :title="$title">
    <div class="min-h-screen w-full filament-app-layout">

        <x-filament-jetstream::layouts.app.top-navigation />

        <div class="w-full space-y-6 flex-1 flex flex-col filament-main">
            <div @class([
                'flex-1 w-full mx-auto filament-main-content',
            ])>
                {{ \Filament\Facades\Filament::renderHook('content.start') }}

                {{ $slot }}

                {{ \Filament\Facades\Filament::renderHook('content.end') }}
            </div>

            <div class="py-4 shrink-0 filament-main-footer">
                <x-filament::footer />
            </div>
            @livewire('notifications')
        </div>
    </div>
</x-filament::layouts.base>
