<x-filament::page class="filament-resources-create-record-page">
    <x-filament-jetstream::grid-section>
        @if(isset($this->pageSectionTitle))
        <x-slot name="title">
            {{ $this->pageSectionTitle }}
        </x-slot>
        @endif

        @if(isset($this->pageSectionDescription))
        <x-slot name="description">
            {{ $this->pageSectionDescription }}
        </x-slot>
        @endif

        <x-filament::form wire:submit.prevent="create">
            <x-filament::card>
                {{ $this->form }}

                <x-slot name="footer">
                    <div class="flex justify-end">
                        <x-filament::form.actions :actions="$this->getCachedFormActions()" />
                    </div>
                </x-slot>
            </x-filament::card>
        </x-filament::form>
    </x-filament-jetstream::grid-section>
</x-filament::page>
