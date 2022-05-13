@props([
    'active',
    'icon' => null,
    'tag' => 'a',
])

@php
    $iconClasses = \Illuminate\Support\Arr::toCssClasses([
        'mr-2 -ml-1 w-5 h-5 flex-shrink-0 rtl:ml-2 rtl:-mr-1',
        'group-hover:text-white group-focus:text-white',
        'text-primary-500',
    ]);
    $classes = ($active ?? false)
                ? 'flex items-center w-full rounded-none pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition'
                : 'flex items-center w-full rounded-none pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition';
@endphp

@if ($tag === 'form')
    <form {{ $attributes->only(['action', 'method', 'wire:submit.prevent']) }}>
        @csrf

        <button
            type="submit"
            {{ $attributes->except(['action', 'class', 'method', 'wire:submit.prevent'])->class([$classes]) }}
        >
            @if ($icon)
                <x-dynamic-component :component="$icon" :class="$iconClasses" />
            @endif

            {{ $slot }}
        </button>
    </form>
@else
    <a {{ $attributes->merge(['class' => $classes]) }}>
        <div class="inline-flex items-center">
            @if ($icon)
                <x-dynamic-component :component="$icon" :class="$iconClasses" />
            @endif
            {{ $slot }}
        </div>
    </a>
@endif
