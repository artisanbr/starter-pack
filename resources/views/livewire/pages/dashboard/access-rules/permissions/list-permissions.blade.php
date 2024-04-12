<?php

use ArtisanBR\StarterPack\Filters\RoleTableFilter;
use ArtisanBR\StarterPack\Livewire\Pages\Dashboard\AccessRules\Roles\RoleForm;
use ArtisanBR\StarterPack\Models\Role;

/**
 * @var RoleTableFilter $filter
 * @var Role            $row
 * @var Role            $model
 * @var RoleForm        $form
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
    <x-starter-pack::layouts.dashboard.toolbar :title="$title"
                                               subtitle="Gerenciar Permissões de Usuários">
        <x-slot:actions>
            {!! $this->renderActions() !!}
        </x-slot:actions>
    </x-starter-pack::layouts.dashboard.toolbar>

    {{-- Table --}}
    <x-card>
        <x-table :headers="$this->headers()" :rows="$this->rows()" :sort-by="$sortBy" with-pagination
                 wire:model="selectedItems"
                 selectable striped>

            @scope('cell_created_at', $row)
            {{ $row->created_at->format('d/m/Y H:i') }}
            @endscope

            @scope('actions', $row)

            <x-dropdown class="btn-circle btn-outline btn-sm" icon="css.menu">
                @can('view', $row)
                    <x-menu-item title="Visualizar" icon="o-eye" wire:click="show({{ $row->id }})"/>
                @endcan
                @can('update', $row)
                    <x-menu-item title="Editar" icon="o-pencil-square" wire:click="edit({{ $row->id }})"/>
                @endcan
                @can('delete', $row)
                    <x-menu-item title="Excluir" icon="o-trash" wire:click="askToDeleteItem({{ $row->id }})"/>
                @endcan
            </x-dropdown>
            @endscope
        </x-table>
    </x-card>

    {{-- Form Model --}}
    <x-modal wire:model="showFormModal"
             :title="$form->id ? ($readonly ? 'Visualizando' : 'Editando').' '.$form->display_name : 'Nova Permissão'"
             class="backdrop-blur">

        <div>
            <div class="grow flex flex-col gap-5">
                <div class="w-100 grid grid-cols-2 gap-5">
                    <x-input label="Título" wire:model="form.display_name" inline :readonly="$readonly"/>
                    <x-input label="Apelido" wire:model="form.name" inline :readonly="$readonly"/>
                </div>

                <x-textarea label="Descrição" wire:model="form.description" inline :readonly="$readonly"/>

                @if($readonly)
                    <h3>Grupos Vinculados</h3>
                    <div class="flex gap-3">
                        @foreach ($this->modelRoles() as $role)
                            <x-badge :value="$role->display_name" @class(['badge-'.$role->color]) />
                        @endforeach
                    </div>
                @else
                    <x-choices label="Grupos Vinculados" wire:model="form.roles"
                               :options="$roles"
                               searchable/>
                @endif
            </div>
        </div>

        <x-slot:actions>
            <x-button :label="$readonly ? 'Fechar' : 'Cancelar'" @click="$wire.showFormModal = false"/>
            @if(!$readonly)
                <x-button label="Salvar" class="btn-primary" wire:click="save()" spinner/>
            @endif
        </x-slot:actions>
    </x-modal>

    <!-- FILTER DRAWER -->
    <x-drawer wire:model="filterDrawer" title="Filtros" right separator with-close-button class="lg:w-1/3">
        <div class="grid grid-cols-1 gap-3">
            <x-input placeholder="Pesquisar..." wire:model.live.debounce="search" icon="o-magnifying-glass"
                     @keydown.enter="$wire.filterDrawer = false"/>

            @can('viewAny', config('permission.models.permission', 'ArtisanBR\StarterPack\Models\Permission'))
                <x-choices label="Permissões" wire:model="filter.permissions"
                           {{--wire:model.live.debounce="filter.roles"--}}
                           :options="$filter->permissionList()"
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
