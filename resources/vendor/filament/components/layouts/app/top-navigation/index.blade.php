@php
    $user = \Filament\Facades\Filament::auth()->user();
    $userPhoto = \Filament\Facades\Filament::getUserAvatarUrl($user);
    $userName = \Filament\Facades\Filament::getUserName($user);
    $navigation = \Filament\Facades\Filament::getNavigation();
    $manageAccountNavigation = $navigation['Manage Account'] ?? [];
    unset($navigation['Manage Account']);
@endphp
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                    @foreach ($navigation as $group => $items)
                        @if ($group)
                            @php
                                $groupActive = false;
                            @endphp
                            <x-filament::layouts.app.top-navigation.dropdown>
                                <x-slot name="content">
                                    @foreach ($items as $item)
                                        @php
                                            if ($item->isActive()) {
                                                $groupActive = true;
                                            }
                                        @endphp
                                        <x-filament::layouts.app.top-navigation.dropdown-link href="{{ $item->getUrl() }}" :active="$item->isActive()">
                                            <x-dynamic-component :component="$item->getIcon()" class="h-5 w-5" />
                                            {{ $item->getLabel() }}
                                        </x-filament::layouts.app.top-navigation.dropdown-link>
                                    @endforeach
                                </x-slot>
                                <x-slot name="trigger">
                                    <span class="h-full cursor-pointer inline-flex items-center px-1 pt-1 border-b-2 {{ $groupActive ? 'border-indigo-400' : 'border-transparent' }} text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        {{ __($group) }}
                                    </span>
                                </x-slot>
                            </x-filament::layouts.app.top-navigation.dropdown>
                        @else
                            @foreach ($items as $item)
                                <x-filament::layouts.app.top-navigation.nav-link href="{{ $item->getUrl() }}" :active="$item->isActive()">
                                    <x-dynamic-component :component="$item->getIcon()" class="h-5 w-5" />
                                    {{ $item->getLabel() }}
                                </x-filament::layouts.app.top-navigation.nav-link>
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
                    <x-filament::layouts.app.top-navigation.dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if ($userPhoto)
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ $userPhoto }}" alt="{{ $userName }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ $userName }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            @foreach($manageAccountNavigation as $item)
                                <x-filament::layouts.app.top-navigation.dropdown-link href="{{ $item->getUrl() }}">
                                    {{ $item->getLabel() }}
                                </x-filament::layouts.app.top-navigation.dropdown-link>
                            @endforeach

                            <div class="border-t border-gray-100"></div>

                            <x-filament::layouts.app.top-navigation.dropdown-link href="{{ route('filament.auth.logout') }}">
                                {{ __('filament::layout.buttons.logout.label') }}
                            </x-filament::layouts.app.top-navigation.dropdown-link>
                        </x-slot>
                    </x-filament::layouts.app.top-navigation.dropdown>
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
            @foreach ($navigation as $group => $items)
                @if ($group)
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ $group }}
                    </div>
                @endif
                @foreach ($items as $item)
                    <x-filament::layouts.app.top-navigation.responsive-nav-link href="{{ $item->getUrl() }}" :active="$item->isActive()">
                        <x-dynamic-component :component="$item->getIcon()" class="h-5 w-5" />
                        {{ $item->getLabel() }}
                    </x-filament::layouts.app.top-navigation.responsive-nav-link>
                @endforeach
            @endforeach
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if ($userPhoto)
                    <div class="shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ $userPhoto }}" alt="{{ $userName }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ $userName }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">

                @foreach($manageAccountNavigation as $item)
                    <x-filament::layouts.app.top-navigation.responsive-nav-link href="{{ $item->getUrl() }}">
                        {{ $item->getLabel() }}
                    </x-filament::layouts.app.top-navigation.responsive-nav-link>
                @endforeach

                <x-filament::layouts.app.top-navigation.responsive-nav-link href="{{ route('filament.auth.logout') }}">
                    {{ __('filament::layout.buttons.logout.label') }}
                </x-filament::layouts.app.top-navigation.responsive-nav-link>
            </div>
        </div>
    </div>
</nav>
