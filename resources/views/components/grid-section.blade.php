<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    @if(isset($title))
    <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">
                {{ $title }}
            </h3>

            <p class="mt-1 text-sm text-gray-600">
                {{ $description ?? '' }}
            </p>
        </div>
    </div>
    @endif

    <div class="mt-5 md:mt-0 md:col-span-{{ isset($title) ? '2' : '3' }}">
        {{ $slot }}
    </div>
</div>
