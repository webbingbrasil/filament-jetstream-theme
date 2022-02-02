@if($responsive)
@else
    @foreach(config('filament'))
        <x-filament::layouts.app.top-navigation.dropdown-link href="{{ route('filament.auth.logout') }}">
            {{ __('filament::layout.buttons.logout.label') }}
        </x-filament::layouts.app.top-navigation.dropdown-link>
    @endforeach
@endif
