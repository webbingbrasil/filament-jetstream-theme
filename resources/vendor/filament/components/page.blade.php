@props([
    'modals' => null,
    'widgetRecord' => null,
])

@php
    $breadcrumbs = $this->getBreadcrumbs();
@endphp

<div {{ $attributes->class(['filament-page']) }}>
    <div class="space-y-6">
        @if ($header = $this->getHeader())
            {{ $header }}
        @elseif ($heading = $this->getHeading())
            <x-filament::header :actions="$this->getCachedActions()">
                <x-slot name="heading">
                    {{ $heading }}
                </x-slot>
            </x-filament::header>
        @endif

        @if(!empty($breadcrumbs))
            <header class="h-[4rem] shrink-0 w-full border-b flex items-center">
                <div @class([
                'flex items-center w-full px-2 mx-auto sm:px-4 md:px-6 lg:px-8',
                match (config('filament.layout.max_content_width')) {
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
                    <div class="flex-1 flex items-center justify-between">
                        <div>
                            <ul class="hidden gap-4 items-center font-medium text-sm lg:flex">
                                @foreach ($breadcrumbs as $url => $label)
                                    <li>
                                        <a
                                            href="{{ is_int($url) ? '#' : $url }}"
                                            @class([
                                                'text-gray-500' => $loop->last,
                                            ])
                                        >
                                            {{ $label }}
                                        </a>
                                    </li>

                                    @if (! $loop->last)
                                        <li class="h-6 border-r border-gray-300 -skew-x-12"></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
        @endif

        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if ($headerWidgets = $this->getHeaderWidgets())
                    <x-filament::widgets :widgets="$headerWidgets" :data="['record' => $widgetRecord]" />
                @endif


                {{ $slot }}

                @if ($footerWidgets = $this->getFooterWidgets())
                    <x-filament::widgets :widgets="$footerWidgets" :data="['record' => $widgetRecord]" />
                @endif

                @if ($footer = $this->getFooter())
                    {{ $footer }}
                @endif
            </div>
        </div>
    </div>

    <form wire:submit.prevent="callMountedAction">
        @php
            $action = $this->getMountedAction();
        @endphp

        <x-filament::modal id="page-action" :width="$action?->getModalWidth()" display-classes="block">
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

                <x-slot name="footer">
                    <x-filament::modal.actions :full-width="$action->isModalCentered()">
                        @foreach ($action->getModalActions() as $modalAction)
                            {{ $modalAction }}
                        @endforeach
                    </x-filament::modal.actions>
                </x-slot>
            @endif
        </x-filament::modal>
    </form>

    {{ $modals }}

    @if ($notification = session()->get('notification'))
        <x-filament::notification :message="$notification['message']" :status="$notification['status']" />
    @endif
</div>
