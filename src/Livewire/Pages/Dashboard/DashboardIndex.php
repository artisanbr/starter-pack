<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Livewire\Pages\Dashboard;

use ArtisanBR\StarterPack\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Title;
use Livewire\Component;
use Mary\Traits\Toast;

class DashboardIndex extends Component
{
    use Toast;

    //public string $title = 'Painel de Controle';

    public string $search = '';

    public int $countUsers = 0;

    public function mount(): void
    {
        $this->countUsers = User::count();
    }

    #[Title('Painel de Controle')]
    public function render(): View|Application|string
    {
        return view('starter-pack::livewire.pages.dashboard.index');
    }
}
