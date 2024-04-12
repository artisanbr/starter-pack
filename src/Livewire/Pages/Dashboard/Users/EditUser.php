<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Livewire\Pages\Dashboard\Users;

use ArtisanBR\AbstractTallCrud\Livewire\AbstractModelFormComponent;
use ArtisanBR\StarterPack\Http\Resources\RolePermissionChoiceResource;
use ArtisanBR\StarterPack\Models\Role;
use ArtisanBR\StarterPack\Models\User;
use ArtisanBR\StarterPack\Repositories\UserRepository;
use Livewire\WithFileUploads;
use Override;
use Throwable;

class EditUser extends AbstractModelFormComponent
{
    use WithFileUploads;

    public User $model;

    public UserForm $form;

    /*public function __construct(
        public User $model = new User()
    ) {
        parent::__construct();
    }*/

    protected string $repositoryClass = UserRepository::class;

    public bool $changePassword = false;

    public array $roles = [];

    public function mount(User $user): void
    {
        $this->setModel($user, true);
        $this->form->fill([
            'roles' => $this->model->roles->pluck('id')->toArray(),
        ]);
        $this->roles = RolePermissionChoiceResource::collection(Role::all())->toArray(request());
    }

    public function modelRoles()
    {
        return $this->model->roles;
    }

    #[Override]
    public function deleteItem(mixed $item)
    {
        $result = parent::deleteItem($item);

        if ($result) {
            return redirect(route('dashboard.users.index'));
        }

        return $result;
    }

    /**
     * @throws Throwable
     */
    public function save(): void
    {
        if ($this->form->save($this->model)) {
            $this->toast()->success('Usuário salvo!', 'Informações armazenadas com sucesso!')->send();
            $this->model->refresh();
        } else {
            $this->toast()->error('Ops! Algo deu errado...', 'Falha ao salvar o registro')->send();
        }
    }

    public function toggleChangePassword(): void
    {
        $this->changePassword = ! $this->changePassword;
    }

    public function render()
    {
        return view('starter-pack::livewire.pages.dashboard.users.form-user');
    }
}
