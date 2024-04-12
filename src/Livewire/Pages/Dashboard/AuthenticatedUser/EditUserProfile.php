<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Livewire\Pages\Dashboard\AuthenticatedUser;

use ArtisanBR\AbstractTallCrud\Livewire\AbstractModelFormComponent;
use ArtisanBR\StarterPack\Models\User;
use ArtisanBR\StarterPack\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class EditUserProfile extends AbstractModelFormComponent
{
    public string $title = 'Editar Meu Perfil';

    protected ?string $modelClass = User::class;

    protected string $repositoryClass = UserRepository::class;

    public function mount(): void
    {
        $this->countUsers = User::count();
    }

    public function save()
    {

    }

    public function render(): View|Application|string
    {
        return view('starter-pack::livewire.pages.dashboard.index')->title($this->title);
    }
}
