@props([
'modals' => null,
'widgetData' => [],
])

<div {{ $attributes->class(['filament-page']) }}>
    <div class="space-y-6">
        <div @class([
            'shadow bg-white px-4 sm:px-6 lg:px-8 ',
            'dark:bg-gray-800' => config('filament.dark_mode'),
        ])>
            @if ($header = $this->getHeader())
                {{ $header }}
            @elseif ($heading = $this->getHeading())
                <x-filament::header :actions="$this->getCachedActions()">
                    <x-slot name="heading">
                        {{ $heading }}
                    </x-slot>
                </x-filament::header>
            @endif
        </div>
        <div class="space-y-6 px-4 md:px-6 lg:px-8">

            <x-filament::layouts.app.topbar.breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" />

            @if ($headerWidgets = $this->getHeaderWidgets())
                <x-filament::widgets :widgets="$headerWidgets" :data="$widgetData" />
            @endif

            {{ $slot }}

            @if ($footerWidgets = $this->getFooterWidgets())
                <x-filament::widgets :widgets="$footerWidgets" :data="$widgetData" />
            @endif

            @if ($footer = $this->getFooter())
                {{ $footer }}
            @endif
        </div>
    </div>

    <form wire:submit.prevent="callMountedAction">
        @php
            $action = $this->getMountedAction();
        @endphp

        <x-filament::modal id="page-action" :visible="filled($action)" :width="$action?->getModalWidth()" display-classes="block">
            @if ($action)
                @if ($action->isModalCentered())
                    <x-slot name="heading">
                        {{ $action->getModalHeading() }}
                    </x-slot>

                    @if ($subheading = $action->getModalSubheading())
                        <x-slot name="subheading">
                            {{ $subheading }}
                        </x-slot>
                    @endif
                @else
                    <x-slot name="header">
                        <x-filament::modal.heading>
                            {{ $action->getModalHeading() }}
                        </x-filament::modal.heading>
                    </x-slot>
                @endif

                @if ($action->hasFormSchema())
                    {{ $this->getMountedActionForm() }}
                @endif

                @if (count($action->getModalActions()))
                    <x-slot name="footer">
                        <x-filament::modal.actions :full-width="$action->isModalCentered()">
                            @foreach ($action->getModalActions() as $modalAction)
                                {{ $modalAction }}
                            @endforeach
                        </x-filament::modal.actions>
                    </x-slot>
                @endif
            @endif
        </x-filament::modal>
    </form>

    {{ $this->modal }}

    @stack('modals')

    <x-filament::notification-manager />
</div>
