<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Livewire\Pages\Dashboard\Users;

use ArtisanBR\AbstractTallCrud\Livewire\AbstractModelFormComponent;
use ArtisanBR\StarterPack\Models\User;
use Livewire\WithFileUploads;
use Throwable;

class CreateUser extends AbstractModelFormComponent
{
    use WithFileUploads;

    public UserForm $form;

    public User $model;

    /*public function __construct(
        public User $model = new User()
    ) {
        parent::__construct();
    }*/

    public function mount(): void
    {
        $this->setModel(new User(), true);
    }

    /**
     * @throws Throwable
     */
    public function save(): void
    {
        if ($this->form->save($this->model)) {
            $this->toast()->success('Usuário criado com sucesso!', 'Informações armazenadas com sucesso!')->send();
            $this->model->refresh();
            $this->redirect(route('dashboard.users.edit', $this->model->id));
        } else {
            $this->toast()->error('Ops! Algo deu errado...', 'Falha ao salvar o registro')->send();
        }
    }

    public function render()
    {
        return view('starter-pack::livewire.pages.dashboard.users.form-user')->with([
            'changePassword' => false,
        ]);
    }
}
