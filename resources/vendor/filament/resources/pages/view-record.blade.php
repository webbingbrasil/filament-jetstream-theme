<x-filament::page :widget-data="['record' => $record]" class="filament-resources-view-record-page">
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

        <x-filament::card>
            {{ $this->form }}
        </x-filament::card>

        @if (count($relationManagers = $this->getRelationManagers()))
            <x-filament::hr />

            <x-filament::resources.relation-managers :active-manager="$activeRelationManager" :managers="$relationManagers" :owner-record="$record" :page-class="static::class" />
        @endif
    </x-filament-jetstream::grid-section>
</x-filament::page>
