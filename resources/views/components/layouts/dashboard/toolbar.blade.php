@props([
    'title' => null,
    'subtitle' => null,
    'size' => 'text-3xl',
    'middle' => null,
    'actions' => null,
    'search' => false
])
<x-header :title="$title" :subtitle="$subtitle" :size="$size" separator progress-indicator {{ $attributes }}>
    @if($subtitle)
        <x-slot:subtitle @class(['dark:text-gray-400 text-lg', is_string($subtitle) ? '' : $subtitle?->attributes->get('class') ])>
            {{ $subtitle }}
        </x-slot:subtitle>
    @endif

    <x-slot:middle class="!justify-end">
        @if($middle)
            {{ $middle }}
        @elseif($search)
            <x-input placeholder="Buscar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass"/>
        @endif

    </x-slot:middle>
    @if($actions ?? false)
        <x-slot:actions @class(["gap-4", is_string($actions) ? '' : $actions?->attributes->get('class') ])>
            {{--<x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" />--}}
            {{ $actions }}
        </x-slot:actions>
    @endif
</x-header>
