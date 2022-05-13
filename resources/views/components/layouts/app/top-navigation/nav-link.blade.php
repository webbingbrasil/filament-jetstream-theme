@props([
    'active',
    'icon' => null,
    'tag' => 'button',
])

@php
    $iconClasses = \Illuminate\Support\Arr::toCssClasses([
        'mr-2 -ml-1 w-6 h-6 flex-shrink-0 rtl:ml-2 rtl:-mr-1',
        'group-hover:text-white group-focus:text-white',
        'text-primary-500',
    ]);
    $classes = ($active ?? false)
                ? 'flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition'
                : 'flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition';
@endphp

@if ($tag === 'form')
    <form {{ $attributes->only(['action', 'method', 'wire:submit.prevent']) }}>
        @csrf

        <button
            type="submit"
            {{ $attributes->except(['action', 'class', 'method', 'wire:submit.prevent'])->class([$buttonClasses]) }}
        >
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
