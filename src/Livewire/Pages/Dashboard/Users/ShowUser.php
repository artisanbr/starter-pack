<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Livewire\Pages\Dashboard\Users;

use ArtisanBR\AbstractTallCrud\Livewire\AbstractModelFormComponent;
use ArtisanBR\StarterPack\Models\User;
use ArtisanBR\StarterPack\Repositories\UserRepository;
use Override;

class ShowUser extends AbstractModelFormComponent
{
    public User $model;

    public UserForm $form;

    protected string $repositoryClass = UserRepository::class;

    public bool $changePassword = false;

    public function mount(User $user): void
    {
        $this->setModel($user, true);
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

    public function render()
    {
        return view('starter-pack::livewire.pages.dashboard.users.form-user')
            ->with([
                'readonly' => true,
            ]);
    }
}
