@php
    $user = \Filament\Facades\Filament::auth()->user();
    $navigation = \Filament\Facades\Filament::getNavigation();
    $userMenuItems = \Filament\Facades\Filament::getUserMenuItems();
    $accountItem = $userMenuItems['account'] ?? null;
    $logoutItem = $userMenuItems['logout'] ?? null;
@endphp
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div @class([match (config('filament.layout.max_content_width')) {
                    'xl' => 'max-w-xl',
                    '2xl' => 'max-w-2xl',
                    '3xl' => 'max-w-3xl',
                    '4xl' => 'max-w-4xl',
                    '5xl' => 'max-w-5xl',
                    '6xl' => 'max-w-6xl',
                    'full' => 'max-w-full',
                    default => 'max-w-7xl',
                },'mx-auto px-4 sm:px-6 lg:px-8'])>
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ config('filament.home_url') }}">
                        <x-filament::brand />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @foreach ($navigation as $group => ['items' => $items, 'collapsible' => $collapsible])
                        @if ($group)
                            @php
                                $groupActive = false;
                            @endphp
                            <x-filament-jetstream::layouts.app.top-navigation.dropdown>
                                <x-slot name="content">
                                    @foreach ($items as $item)
                                        @php
                                            if ($item->isActive()) {
                                                $groupActive = true;
                                            }
                                        @endphp
                                        <x-filament-jetstream::layouts.app.top-navigation.dropdown-link
                                            href="{{ $item->getUrl() }}"
                                            :icon="$item->getIcon()"
                                            :active="$item->isActive()">
                                            {{ $item->getLabel() }}
                                        </x-filament-jetstream::layouts.app.top-navigation.dropdown-link>
                                    @endforeach
                                </x-slot>
                                <x-slot name="trigger">
                                    <span class="h-full cursor-pointer inline-flex items-center px-1 pt-1 border-b-2 {{ $groupActive ? 'border-indigo-400' : 'border-transparent' }} text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        {{ __($group) }}
                                    </span>
                                </x-slot>
                            </x-filament-jetstream::layouts.app.top-navigation.dropdown>
                        @else
                            @foreach ($items as $item)
                                <x-filament-jetstream::layouts.app.top-navigation.nav-link
                                    href="{{ $item->getUrl() }}"
                                    :icon="$item->getIcon()"
                                    :active="$item->isActive()">
                                    {{ $item->getLabel() }}
                                </x-filament-jetstream::layouts.app.top-navigation.nav-link>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <div class="ml-3 relative">
                    @livewire('filament.core.global-search')
                </div>
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-filament::layouts.app.topbar.user-menu />
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @foreach ($navigation as $group => ['items' => $items, 'collapsible' => $collapsible])
                @if ($group)
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ $group }}
                    </div>
                @endif
                @foreach ($items as $item)
                    <x-filament-jetstream::layouts.app.top-navigation.responsive-nav-link
                        href="{{ $item->getUrl() }}"
                        :icon="$item->getIcon()"
                        :active="$item->isActive()">
                        {{ $item->getLabel() }}
                    </x-filament-jetstream::layouts.app.top-navigation.responsive-nav-link>
                @endforeach
            @endforeach
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <ul @class([
            'py-1 space-y-1 overflow-hidden ',
            'dark:border-gray-600 dark:bg-gray-700' => config('filament.dark_mode'),
        ])>
                <x-filament-jetstream::layouts.app.top-navigation.responsive-nav-link
                    :icon="$accountItem?->getIcon() ?? 'heroicon-s-user-circle'"
                    href="$accountItem?->getUrl()"
                >
                    {{ $accountItem?->getLabel() ?? \Filament\Facades\Filament::getUserName($user) }}
                </x-filament-jetstream::layouts.app.top-navigation.responsive-nav-link>

                @foreach ($userMenuItems as $key => $item)
                    @if ($key !== 'account' && $key !== 'logout')
                        <x-filament-jetstream::layouts.app.top-navigation.responsive-nav-link
                            href="{{ $item->getUrl() }}"
                            :icon="$item->getIcon()">
                            {{ $item->getLabel() }}
                        </x-filament-jetstream::layouts.app.top-navigation.responsive-nav-link>
                    @endif
                @endforeach

                <x-filament-jetstream::layouts.app.top-navigation.responsive-nav-link
                    :icon="$logoutItem?->getIcon() ?? 'heroicon-s-logout'"
                    :action="$logoutItem?->getUrl() ?? route('filament.auth.logout')"
                    method="post"
                    tag="form"
                >
                    {{ $logoutItem?->getLabel() ?? __('filament::layout.buttons.logout.label') }}
                </x-filament-jetstream::layouts.app.top-navigation.responsive-nav-link>
            </ul>
        </div>
    </div>
</nav>
