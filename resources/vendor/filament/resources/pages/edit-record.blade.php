<x-filament::page :widget-record="$record" class="filament-resources-edit-record-page">
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

        <x-filament::form wire:submit.prevent="save">
            <x-filament-jetstream::card>
                {{ $this->form }}

                @if (count($relationManagers = $this->getRelationManagers()))
                    <x-filament::hr />

                    <x-filament::resources.relation-managers :active-manager="$activeRelationManager" :managers="$relationManagers" :owner-record="$record" />
                @endif

                <x-slot name="actions">
                    <x-filament::form.actions :actions="$this->getFormActions()" />
                </x-slot>
            </x-filament-jetstream::card>
        </x-filament::form>
    </x-filament-jetstream::grid-section>
</x-filament::page>
