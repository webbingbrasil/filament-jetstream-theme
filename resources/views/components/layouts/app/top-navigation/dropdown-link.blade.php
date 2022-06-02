@props([
    'active' => false,
    'icon' => null,
    'darkMode'
])
@php
    $iconClasses = \Illuminate\Support\Arr::toCssClasses([
        'mr-2 -ml-1 w-6 h-6 flex-shrink-0 rtl:ml-2 rtl:-mr-1 text-gray-500',
        'group-hover:text-white group-focus:text-white',
    ]);

    $classes = [
        'flex group items-center px-4 py-2 text-sm leading-5 border-b-2 focus:outline-none transition duration-150 ease-in-out',
        'border-transparent hover:bg-gray-100 focus:bg-gray-100' => !$active,
        'border-indigo-400 hover:bg-gray-100 focus:bg-gray-100 ' => $active,
        'hover:bg-primary-600 focus:bg-primary-700' => $darkMode,
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
