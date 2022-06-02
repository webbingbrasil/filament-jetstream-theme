@props([
    'maxContentWidth' => null,
])

<x-filament::layouts.base :title="$title">
    <div class="min-h-screen w-full filament-app-layout">
{{--    <div class="flex min-h-screen overflow-x-hidden w-full filament-app-layout">--}}

        <x-filament-jetstream::layouts.app.top-navigation />
{{--        <x-filament::layouts.app.sidebar />--}}

        <div class="w-full space-y-6 flex-1 flex flex-col filament-main">
            <div @class([
                'flex-1 w-full mx-auto filament-main-content',
                match ($maxContentWidth ?? config('filament.layout.max_content_width')) {
                    'xl' => 'max-w-xl',
                    '2xl' => 'max-w-2xl',
                    '3xl' => 'max-w-3xl',
                    '4xl' => 'max-w-4xl',
                    '5xl' => 'max-w-5xl',
                    '6xl' => 'max-w-6xl',
                    'full' => 'max-w-full',
                    default => 'max-w-7xl',
                },
            ])>
                {{ \Filament\Facades\Filament::renderHook('content.start') }}

                {{ $slot }}

                {{ \Filament\Facades\Filament::renderHook('content.end') }}
            </div>

            <div class="py-4 shrink-0 filament-main-footer">
                <x-filament::footer />
            </div>
        </div>
    </div>
</x-filament::layouts.base>
