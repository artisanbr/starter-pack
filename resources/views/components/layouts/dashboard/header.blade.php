@props([
    'start' => null,
    'middle' => null,
    'end' => null,
    'search' => false
])

<div {{ $attributes->class(['flex flex-wrap gap-4 justify-between items-center']) }}>
    @if($start)
        <div @class(["flex items-center gap-3 order-first sm:order-none", is_string($start) ? '' : $start?->attributes->get('class')])>
            {{ $start }}
        </div>
    @endif

    @if($middle || $search)
        <div @class(["flex items-center justify-center gap-3 grow order-last sm:order-none", is_string($middle) ? '' : $middle?->attributes->get('class')])>
            @if($middle)
                {{ $middle }}
            @elseif($search)
                <x-input :placeholder="__('Buscar...')" wire:model.live.debounce="search" clearable
                         icon="o-magnifying-glass"/>
            @endif
        </div>
    @endif

    @if($end)
        <div @class(["flex items-center gap-2 w-full lg:w-auto", is_string($end) ? '' : $end?->attributes->get('class')])>
            {{ $end }}
        </div>
    @endif

    {{ $slot }}
</div>
