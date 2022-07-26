@php
    $user = \Filament\Facades\Filament::auth()->user();
    $navigation = \Filament\Facades\Filament::getNavigation();
    $userMenuItems = \Filament\Facades\Filament::getUserMenuItems();
    $accountItem = $userMenuItems['account'] ?? null;
    $logoutItem = $userMenuItems['logout'] ?? null;
    $darkMode = config('filament.dark_mode');
@endphp
<nav x-data="{ open: false }" @class([
        "bg-white border-b border-gray-100",
        'dark:border-gray-600 dark:bg-gray-800' => config('filament.dark_mode'),
    ])>
    <!-- Primary Navigation Menu -->
    <div @class(['mx-auto px-4 sm:px-6 lg:px-8'])>
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
                    @foreach ($navigation as $group)
                        @if (filled($group->getLabel()))
                            @php
                                $groupActive = false;
                            @endphp
                            <x-filament-jetstream::layouts.app.top-navigation.dropdown>
                                <x-slot name="content">
                                    @foreach ($group->getItems() as $item)
                                        @php
                                            if ($item->isActive()) {
                                                $groupActive = true;
                                            }
                                        @endphp
                                        <x-filament-jetstream::layouts.app.top-navigation.dropdown-link
                                            href="{{ $item->getUrl() }}"
                                            :icon="$item->getIcon()"
                                            :active="$item->isActive()"
                                            :darkMode="$darkMode">
                                            {{ $item->getLabel() }}
                                        </x-filament-jetstream::layouts.app.top-navigation.dropdown-link>
                                    @endforeach
                                </x-slot>
                                <x-slot name="trigger">
                                    <span @class([
                                                "h-full cursor-pointer border-transparent inline-flex items-center px-1",
                                                "pt-1 border-b-2 text-sm font-medium leading-5 focus:outline-none transition",
                                                "duration-150 ease-in-out hover:border-gray-300 focus:border-gray-300",
                                                "hover:text-gray-700 focus:text-gray-700" => !$darkMode,
                                                "border-indigo-400" => $groupActive,
                                                'dark:hover:text-white dark:focus:text-white' => $darkMode,
                                            ])>
                                        {{ __($group) }}
                                    </span>
                                </x-slot>
                            </x-filament-jetstream::layouts.app.top-navigation.dropdown>
                        @else
                            @foreach ($group->getItems() as $item)
                                <x-filament-jetstream::layouts.app.top-navigation.nav-link
                                    href="{{ $item->getUrl() }}"
                                    :icon="$item->getIcon()"
                                    :active="$item->isActive()"
                                    :darkMode="$darkMode">
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
            @foreach ($navigation as $group)
                @if (filled($group->getLabel()))
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ $group->getLabel() }}
                    </div>
                @endif
                @foreach ($group->getItems() as $item)
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
