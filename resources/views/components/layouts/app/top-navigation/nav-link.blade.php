@props([
    'active' => false,
    'icon' => null,
    'darkMode'
])

@php
    $iconClasses = \Illuminate\Support\Arr::toCssClasses([
        'mr-2 -ml-1 w-6 h-6 flex-shrink-0 rtl:ml-2 rtl:-mr-1 text-gray-500',
        'dark:text-white ' => $darkMode,
    ]);
    $classes = [
        'flex dark:group items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 focus:outline-none transition border-transparent',
        'hover:border-gray-300 focus:border-gray-300' => !$active,
        'border-indigo-400 focus:border-indigo-700' => $active,
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
