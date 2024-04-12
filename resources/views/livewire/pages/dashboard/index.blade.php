<div>
    <!-- HEADER -->
    <x-layouts.dashboard.header title="Painel de Controle" subtitle="Seja bem-vindo!"/>

    <div class="grid grid-cols-4 gap-4">
        <x-stat
            title="Usuários"
            description="Total de Usuários Ativos"
            :value="$countUsers"
            icon="o-users"/>

        <x-stat
            title="Usuários"
            description="Total de Usuários Ativos"
            :value="$countUsers"
            icon="o-arrow-trending-up"
            tooltip-bottom="There"/>

        <x-stat
            title="Usuários"
            description="Total de Usuários Ativos"
            :value="$countUsers"
            icon="o-arrow-trending-up"
            tooltip-bottom="There"/>

    </div>


    {{--<x-card>

    </x-card>--}}

    <!-- FILTER DRAWER -->
    {{--<x-drawer wire:model="drawer" title="Filters" right separator with-close-button class="lg:w-1/3">
        <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass"
                 @keydown.enter="$wire.drawer = false"/>

        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner/>
            <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false"/>
        </x-slot:actions>
    </x-drawer>--}}
</div>
