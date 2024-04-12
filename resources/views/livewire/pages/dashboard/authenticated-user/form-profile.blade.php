@php use ArtisanBR\StarterPack\Models\User; @endphp
<?php
/**
 * @var User $model
 *
 */
?>

<div>
    <!-- HEADER -->
    <x-layouts.dashboard.header title="Cadastro de Usuário"
                                :subtitle="!blank($model->name) ? $model->name : 'Novo Usuário'"/>

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
                            crop-save-text="Continuar" crop-after-change>
                        <img src="{{ $model->avatar_url }}" class="h-40 rounded-lg" alt="User Avatar"/>
                    </x-file>
                </div>
                <div class="grow flex flex-col gap-5">
                    <x-input label="Nome" wire:model="form.name" inline/>
                    <div class="w-100 grid grid-cols-2 gap-5">
                        <x-input label="Email" wire:model="form.email" inline/>
                        <x-input label="Apelido / Usuário" wire:model="form.username" inline/>
                    </div>
                    <div>
                        @if($changePassword || !$model->id)
                            <x-hr/>

                            <div class="grid grid-cols-2 gap-5">
                                <x-input type="password" label="Nova Senha" wire:model="form.new_password"
                                         :hint="$model->id ? 'Deixe em branco para manter a senha atual' : ''" inline/>
                                <x-input type="password" label="Confirmar Nova Senha"
                                         wire:model="form.new_password_confirmation"
                                         inline/>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex justify-between gap-3">
                @if($model->id)
                    <x-button :label="$changePassword ? 'Ocultar Nova Senha' : 'Alterar Senha'"
                              class="btn-accent justify-self-start"
                              wire:click="toggleChangePassword"
                              spinner/>
                @endif

                <div class="flex gap-3 justify-end">
                    <x-button label="Cancelar" :link="route('dashboard.users.index')"/>
                    <x-button label="Salvar" class="btn-primary" type="submit" spinner="save"/>
                </div>
            </div>
        </x-form>
    </x-card>
</div>
