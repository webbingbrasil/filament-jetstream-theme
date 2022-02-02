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
            <x-filament-jetstream::card>
                {{ $this->form }}

                <x-slot name="actions">
                    <x-filament::form.actions :actions="$this->getFormActions()" />
                </x-slot>
            </x-filament-jetstream::card>
        </x-filament::form>
    </x-filament-jetstream::grid-section>
</x-filament::page>
