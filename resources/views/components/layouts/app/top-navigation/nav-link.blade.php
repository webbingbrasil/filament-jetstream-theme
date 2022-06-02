@props([
    'active' => false,
    'icon' => null,
    'darkMode'
])

@php
    $iconClasses = \Illuminate\Support\Arr::toCssClasses([
        'mr-2 -ml-1 w-6 h-6 flex-shrink-0 rtl:ml-2 rtl:-mr-1',
        'group-hover:text-white group-focus:text-white',
        'text-gray-500',
    ]);
    $classes = [
        'flex group items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 focus:outline-none transition border-transparent',
        'hover:text-gray-700 hover:border-gray-300 focus:text-gray-700 focus:border-gray-300' => !$active && !$darkMode,
        'border-indigo-400 focus:border-indigo-700' => $active,
        'dark:hover:text-white dark:focus:text-white' => $darkMode,
    ];
@endphp

<a {{ $attributes->class($classes) }}>
    <div class="inline-flex items-center">
        @if ($icon)
            <x-dynamic-component :component="$icon" :class="$iconClasses" />
        @endif
        {{ $slot }}
    </div>
</a>
