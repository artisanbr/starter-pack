<?php

use ArtisanBR\StarterPack\Models\User;
use ArtisanBR\StarterPack\Livewire\Pages\Dashboard\Users\UserForm;

/**
 * @var User $model
 *
 */
?>

@php
    $readonly = $model?->id && ($readonly ?? false);
@endphp


<div>
    <!-- HEADER -->
    <x-starter-pack::layouts.dashboard.toolbar :title="$readonly ? 'Visualizar Usuário' : 'Cadastro de Usuário'"
                                               :subtitle="!blank($model->name) ? 'Editando '. $form->name : 'Novo Usuário'">
        <x-slot:actions class="gap-5">


            @if($readonly)
                @can('update', $model)
                    <x-button class="btn-primary" :link="route('dashboard.users.edit', $model->id)" label="Editar"
                              icon="o-pencil-square"/>
                @endcan
            @elseif($model->id)
                @can('view', $model)
                    <x-button class="btn-primary" :link="route('dashboard.users.show', $model->id)" label="Visualizar"
                              icon="o-eye"/>
                @endcan

                @can('create', config('auth.providers.users.model', 'ArtisanBR\StarterPack\Models\User'))
                    <x-button class="btn-secondary" :link="route('dashboard.users.create')" label="Novo Usuário"
                              icon="o-user-plus"/>
                @endcan
            @endif
        </x-slot:actions>
    </x-starter-pack::layouts.dashboard.toolbar>

    <!-- TABLE  -->
    <x-card>
        <x-form wire:submit="save">

            <div class="flex flex-row mb-3 gap-3">
                <div>
                    <x-file wire:model="form.avatar_upload" accept="image/png, image/jpeg, image/webp" class=" mb-3"
                            change-text="Mudar Avatar"
                            crop-text="Cortar"
                            crop-title-text="Cortar imagem"
                            crop-cancel-text="Cancelar"
                            crop-save-text="Continuar" crop-after-change :disabled="$readonly">
                        <img src="{{ $model->avatar_url }}" class="h-40 rounded-lg" alt="User Avatar"/>
                    </x-file>
                </div>
                <div class="grow flex flex-col gap-5">
                    <x-input label="Nome" wire:model="form.name" inline :readonly="$readonly"/>
                    <div class="w-100 grid grid-cols-2 gap-5">
                        <x-input label="Email" wire:model="form.email" inline :readonly="$readonly"/>
                        <x-input label="Apelido / Usuário" wire:model="form.username" inline :readonly="$readonly"/>
                    </div>
                    <div>
                        @if($changePassword || !$model->id)
                            <x-hr class="mb-10"/>
                            @php($passText = !$model->id ? 'Senha' : 'Nova Senha')
                            <div class="grid grid-cols-2 gap-5 gap-y-2" x-data="{ showPassword: false }">
                                {{--<x-input x-bind:type="showPassword ? 'text' : 'password'" :label="$passText"
                                         wire:model="form.new_password"
                                         :hint="$model->id ? 'Deixe em branco para manter a senha atual' : ''" inline>

                                    <x-slot:append>
                                        --}}{{-- Add `rounded-l-none` class --}}{{--
                                        --}}{{--<x-button label="I am a button" icon="o-check" class="btn-primary rounded-l-none" />--}}{{--
                                        <x-icon name="o-eye" @click="showPassword = !showPassword"/>
                                    </x-slot:append>
                                </x-input>
                                <x-input x-bind:type="showPassword ? 'text' : 'password'"
                                         :label="'Confirmar '.$passText"
                                         wire:model="form.new_password_confirmation"
                                         inline/>
                                <div class="flex justify-end">
                                    <x-starter-pack::password-generator target="form.new_password" has-confirmation
                                                                        class="mt-1"/>
                                </div>--}}
                                <x-ts-password :placeholder="$passText" wire:model="form.new_password"
                                               generator
                                               :rules="['min:8', 'symbols', 'numbers', 'mixed']"
                                               x-on:generate="$wire.$set('form.new_password_confirmation', $event.detail.password)"/>

                                <x-ts-password :placeholder="'Confirmar '.$passText"
                                               wire:model="form.new_password_confirmation"/>
                            </div>

                        @endif
                    </div>

                    @if($readonly)
                        <h3>Grupos do Usuário</h3>
                        <div class="flex gap-3">
                            @foreach ($this->modelRoles() as $role)
                                <x-badge :value="$role->display_name" @class(['badge-'.$role->color]) />
                            @endforeach
                        </div>
                    @else
                        <x-choices label="Grupos do Usuário" wire:model="form.roles"
                                   :options="$roles"
                                   searchable/>
                    @endif
                </div>
            </div>

            <div @class([
                    'flex gap-3',
                    'justify-between' => $model->id,
                    'justify-end' => !$model->id,
                ])>
                <div class="flex gap-5 justify-start">
                    @can('delete', $model)
                        <x-button class="btn-error" label="Excluir"
                                  icon="o-trash" wire:click="askToDeleteItem({{ $model->id }})"/>
                    @endcan
                    @if(!$readonly)
                        <x-button label="Cancelar" :link="route('dashboard.users.index')" icon="tabler.arrow-back-up"/>
                    @else
                        <x-button label="Voltar" @class(['justify-self-start']) :link="route('dashboard.users.index')"
                                  icon="tabler.arrow-back-up"/>
                    @endif
                </div>

                <div class="flex gap-5 justify-end">
                    @if(!$readonly)
                        @if($model->id)
                            <x-button :label="$changePassword ? 'Ocultar Nova Senha' : 'Alterar Senha'"
                                      class="btn-accent justify-self-start"
                                      wire:click="toggleChangePassword"
                                      spinner icon="o-key"/>
                        @endif
                        <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" icon="far.save"/>
                    @else
                        <x-button label="Editar" class="btn-primary" :link="route('dashboard.users.edit', $model->id)"
                                  icon="o-pencil-square"/>
                    @endif

                </div>
            </div>
        </x-form>
    </x-card>
</div>
