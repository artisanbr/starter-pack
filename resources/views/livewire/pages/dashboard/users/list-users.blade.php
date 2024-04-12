<?php

use ArtisanBR\StarterPack\Filters\UserTableFilter;
use ArtisanBR\StarterPack\Models\User;

/**
 * @var UserTableFilter $filter
 * @var User            $row
 *
 */
?>
<div>
    <x-ts-loading loading="rows">
        <div class="flex items-center text-primary-500 dark:text-white">
            {{--<x-tallstack-ui::icon.heroicons.solid.arrow-path class="mr-2 h-10 w-10 animate-spin"/>--}}
            <x-icon name="c-arrow-path" class="mr-2 h-10 w-10 animate-spin text-primary"/>
            Carregando ...
        </div>
    </x-ts-loading>

    <!-- HEADER -->
    <x-starter-pack::layouts.dashboard.toolbar title="Lista de Usuários" subtitle="Gerenciar usuários da plataforma">
        <x-slot:actions>
            {!! $this->renderActions() !!}
        </x-slot:actions>
    </x-starter-pack::layouts.dashboard.toolbar>

    {{-- Table --}}
    <x-card>

        {{--<div x-show="$wire.selectedItems.length">
            <div class="flex justify-between items-center" wire:transition>
                <div>
                    <span x-text="$wire.selectedItems.length"></span> Selecionado(s)
                </div>
                <div class="flex justify-end">
                    <x-button class="btn-error" spinner label="Excluir" icon="o-trash"
                              wire:click="askToDeleteSelected"/>
                </div>
            </div>
        </div>--}}
        {{--<x-ts-table :$headers :$rows paginate striped>
            @interact('column_avatar', $row)
            <a href="{{ route('dashboard.users.edit', $row->id) }}">
                <x-avatar :image="$row->avatar_url" class="!w-10 !rounded-lg !align-middle"/>
            </a>
            @endinteract

            @interact('column_role_name', $row)
            @foreach ($row->roles as $role)
                <x-badge :value="$role->display_name" @class(['badge-'.$role->color]) />
            @endforeach
            @endinteract

            @interact('column_action', $row)
            <x-dropdown class="btn-circle btn-outline btn-sm" icon="css.menu">
                @can('view', $row)
                    <x-menu-item title="Visualizar" icon="o-eye" :link="route('dashboard.users.show', $row->id)"/>
                @endcan
                @can('update', $row)
                    <x-menu-item title="Editar" icon="o-pencil-square"
                                 :link="route('dashboard.users.edit', $row->id)"/>
                @endcan
                @can('delete', $row)
                    <x-menu-item title="Excluir" icon="o-trash" wire:click="askToDeleteItem({{ $row->id }})"/>
                @endcan
            </x-dropdown>
            @endinteract
        </x-ts-table>--}}

        <x-table :headers="$this->headers()" :rows="$this->rows()" :sort-by="$sortBy" with-pagination
                 wire:model="selectedItems"
                 selectable striped>
            @scope('cell_avatar', $row)
            <a href="{{ route('dashboard.users.edit', $row->id) }}">
                <x-avatar :image="$row->avatar_url" class="!w-10 !rounded-lg !align-middle"/>
            </a>

            @endscope
            @scope('cell_role_name', $row)
            @foreach ($row->roles as $role)
                <x-badge :value="$role->display_name" @class(['badge-'.$role->color]) />
            @endforeach
            @endscope
            @scope('actions', $row)

            <x-dropdown class="btn-circle btn-outline btn-sm" icon="css.menu">
                @can('view', $row)
                    <x-menu-item title="Visualizar" icon="o-eye" :link="route('dashboard.users.show', $row->id)"/>
                @endcan
                @can('update', $row)
                    <x-menu-item title="Editar" icon="o-pencil-square"
                                 :link="route('dashboard.users.edit', $row->id)"/>
                @endcan
                @can('delete', $row)
                    <x-menu-item title="Excluir" icon="o-trash" wire:click="askToDeleteItem({{ $row->id }})"/>
                @endcan
            </x-dropdown>
            @endscope
        </x-table>
    </x-card>

    {{-- Delete Model --}}
    {{--<x-modal wire:model="showDeleteConfirmation" title="Deseja excluir?" class="backdrop-blur" persistent>

        <div>
            Não será possivel desfazer essa ação.
        </div>

        <div>
            Clique em "Cancelar" ou pressione ESC para sair.
        </div>

        <x-slot:actions>
            <x-button label="Cancelar" @click="$wire.deleteId = null; $wire.showDeleteConfirmation = false"/>
            @if($deleteId)
                <x-button label="Sim, Excluir" class="btn-error" wire:click="delete()" spinner/>
            @else
                <x-button label="Sim, Excluir Selecionados" class="btn-error" wire:click="deleteSelected()" spinner/>
            @endif
        </x-slot:actions>
    </x-modal>--}}

    <!-- FILTER DRAWER -->
    <x-drawer wire:model="filterDrawer" title="Filtros" right separator with-close-button class="lg:w-1/3">
        <div class="grid grid-cols-1 gap-3">
            <x-input placeholder="Pesquisar..." wire:model.live.debounce="search" icon="o-magnifying-glass"
                     @keydown.enter="$wire.filterDrawer = false"/>

            @can('viewAny', config('auth.providers.users.model', 'ArtisanBR\StarterPack\Models\User'))
                <x-choices label="Grupos" wire:model="filter.roles" {{--wire:model.live.debounce="filter.roles"--}}
                :options="$filter->roleList()"
                           searchable/>
            @endcan

            <div class="grid grid-cols-2 gap-3">
                <x-datepicker label="Criado a partir de:" wire:model="filter.created_from" icon="o-calendar"/>
                <x-datepicker label="Criado até:" wire:model="filter.created_until" icon="o-calendar"/>
            </div>
        </div>

        <x-slot:actions>
            <x-button label="Limpar" icon="o-x-mark" wire:click="clear" spinner/>
            <x-button label="Aplicar" icon="o-check" class="btn-primary" wire:click="applyFilters" spinner/>
        </x-slot:actions>
    </x-drawer>
</div>
