<x-filament::page :widget-record="$record" class="filament-resources-view-record-page">
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

        <x-filament-jetstream::card>
            {{ $this->form }}

            @if (count($relationManagers = $this->getRelationManagers()))
                <x-filament::hr />

                <x-filament::resources.relation-managers :active-manager="$activeRelationManager" :managers="$relationManagers" :owner-record="$record" />
            @endif
        </x-filament-jetstream::card>
    </x-filament-jetstream::grid-section>
</x-filament::page>
