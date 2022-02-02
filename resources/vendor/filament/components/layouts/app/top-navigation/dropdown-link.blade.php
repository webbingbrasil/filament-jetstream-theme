@php
    $classes = ($active ?? false)
        ? 'block px-4 py-2 text-sm leading-5 text-gray-700 border-b-2 border-indigo-400 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out'
        : 'block px-4 py-2 text-sm leading-5 text-gray-700 border-b-2 border-transparent hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <div class="inline-flex items-center">
        {{ $slot }}
    </div>
</a>
