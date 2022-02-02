<x-filament::layouts.base :title="$title">
    <div class="min-h-screen w-full bg-gray-100 text-gray-900 filament-app-layout">
        <div
            x-data="{}"
            x-cloak
            x-show="$store.sidebar.isOpen"
            x-transition.opacity.500ms
            x-on:click="$store.sidebar.close()"
            class="fixed inset-0 z-20 w-full h-full bg-gray-900/50 lg:hidden"
        ></div>

        <x-filament::layouts.app.top-navigation />

        <div class="w-full space-y-3 flex-1 flex flex-col">
            <div @class([
                'flex-1 w-full mx-auto',
                match (config('filament.layout.max_content_width')) {
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
                {{ $slot }}
            </div>

            <div class="py-4 shrink-0">
                <x-filament::footer />
            </div>
        </div>
    </div>
</x-filament::layouts.base>
