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

                    @if ($subheading = $this->getSubheading())
                        <x-slot name="subheading">
                            {{ $subheading }}
                        </x-slot>
                    @endif
                </x-filament::header>
            @endif
        </div>
        <div @class([
                "space-y-6 mx-auto px-4 md:px-6 lg:px-8",
                match ($maxContentWidth ?? config('filament.layout.max_content_width')) {
                    'xl' => 'max-w-xl',
                    '2xl' => 'max-w-2xl',
                    '3xl' => 'max-w-3xl',
                    '4xl' => 'max-w-4xl',
                    '5xl' => 'max-w-5xl',
                    '6xl' => 'max-w-6xl',
                    'full' => 'max-w-full',
                    default => 'max-w-7xl',
                },
            ])>

            <x-filament::layouts.app.topbar.breadcrumbs :breadcrumbs="$this->getBreadcrumbs()" />

            {{ \Filament\Facades\Filament::renderHook('page.header-widgets.start') }}

            @if ($headerWidgets = $this->getVisibleHeaderWidgets())
                <x-filament::widgets
                    :widgets="$headerWidgets"
                    :columns="$this->getHeaderWidgetsColumns()"
                    :data="$widgetData"
                />
            @endif

            {{ \Filament\Facades\Filament::renderHook('page.header-widgets.end') }}

            {{ $slot }}

            {{ \Filament\Facades\Filament::renderHook('page.footer-widgets.start') }}

            @if ($footerWidgets = $this->getVisibleFooterWidgets())
                <x-filament::widgets
                    :widgets="$footerWidgets"
                    :columns="$this->getFooterWidgetsColumns()"
                    :data="$widgetData"
                />
            @endif

            {{ \Filament\Facades\Filament::renderHook('page.footer-widgets.end') }}

            @if ($footer = $this->getFooter())
                {{ $footer }}
            @endif
        </div>
    </div>

    <form wire:submit.prevent="callMountedAction">
        @php
            $action = $this->getMountedAction();
        @endphp

        <x-filament::modal
            id="page-action"
            :wire:key="$action ? $this->id . '.actions.' . $action->getName() . '.modal' : null"
            :visible="filled($action)"
            :width="$action?->getModalWidth()"
            :slide-over="$action?->isModalSlideOver()"
            display-classes="block"
            x-init="livewire = $wire.__instance"
            x-on:modal-closed.stop="if ('mountedAction' in livewire?.serverMemo.data) livewire.set('mountedAction', null)"
        >
            @if ($action)
                @if ($action->isModalCentered())
                    @if ($heading = $action->getModalHeading())
                        <x-slot name="heading">
                            {{ $heading }}
                        </x-slot>
                    @endif

                    @if ($subheading = $action->getModalSubheading())
                        <x-slot name="subheading">
                            {{ $subheading }}
                        </x-slot>
                    @endif
                @else
                    <x-slot name="header">
                        @if ($heading = $action->getModalHeading())
                            <x-filament::modal.heading>
                                {{ $heading }}
                            </x-filament::modal.heading>
                        @endif

                        @if ($subheading = $action->getModalSubheading())
                            <x-filament::modal.subheading>
                                {{ $subheading }}
                            </x-filament::modal.subheading>
                        @endif
                    </x-slot>
                @endif

                {{ $action->getModalContent() }}

                @if ($action->hasFormSchema())
                    {{ $this->getMountedActionForm() }}
                @endif

                {{ $action->getModalFooter() }}

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
</div>
