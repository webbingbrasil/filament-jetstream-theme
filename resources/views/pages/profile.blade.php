<x-filament::page>

    {{ \Filament\Facades\Filament::renderHook('filament-jetstream.profile-page.start') }}

    <x-filament-jetstream::grid-section class="mt-8">

        <x-slot name="title">
            {{ __('filament-jetstream::default.profile-page.profile-form.heading') }}
        </x-slot>

        <x-slot name="description">
            {{ __('filament-jetstream::default.profile-page.profile-form.subheading') }}
        </x-slot>

        <form wire:submit.prevent="updateProfile" class="col-span-2 sm:col-span-1 mt-5 md:mt-0">
            <x-filament::card>

                {{ $this->profileForm }}

                <x-slot name="footer">
                    <div class="text-right">
                        <x-filament::button type="submit">
                            {{ __('filament-jetstream::default.profile-page.submit-button') }}
                        </x-filament::button>
                    </div>
                </x-slot>
            </x-filament::card>
        </form>

    </x-filament-jetstream::grid-section>

    {{ \Filament\Facades\Filament::renderHook('filament-jetstream.profile-page.after-profile-form') }}

    <x-filament::hr />

    <x-filament-jetstream::grid-section>

        <x-slot name="title">
            {{ __('filament-jetstream::default.profile-page.new-password-form.heading') }}
        </x-slot>

        <x-slot name="description">
            {{ __('filament-jetstream::default.profile-page.new-password-form.subheading') }}
        </x-slot>

        <form wire:submit.prevent="updatePassword" class="col-span-2 sm:col-span-1 mt-5 md:mt-0">
            <x-filament::card>

                {{ $this->newPasswordForm }}

                <x-slot name="footer">
                    <div class="text-right">
                        <x-filament::button type="submit">
                            {{ __('filament-jetstream::default.profile-page.submit-button') }}
                        </x-filament::button>
                    </div>
                </x-slot>
            </x-filament::card>
        </form>

    </x-filament-jetstream::grid-section>

    {{ \Filament\Facades\Filament::renderHook('filament-jetstream.profile-page.end') }}

</x-filament::page>
