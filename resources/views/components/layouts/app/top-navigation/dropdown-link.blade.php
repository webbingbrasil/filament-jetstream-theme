@props([
    'icon' => null,
])
@php
    $iconClasses = \Illuminate\Support\Arr::toCssClasses([
        'mr-2 -ml-1 w-6 h-6 flex-shrink-0 rtl:ml-2 rtl:-mr-1',
        'group-hover:text-white group-focus:text-white',
        'text-primary-500',
    ]);
    $classes = ($active ?? false)
        ? 'flex items-center px-4 py-2 text-sm leading-5 text-gray-700 border-b-2 border-indigo-400 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out'
        : 'flex items-center px-4 py-2 text-sm leading-5 text-gray-700 border-b-2 border-transparent hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <div class="inline-flex items-center">
        @if ($icon)
            <x-dynamic-component :component="$icon" :class="$iconClasses" />
        @endif
        {{ $slot }}
    </div>
</a>
