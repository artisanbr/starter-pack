<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Livewire\Pages\Auth;

use ArtisanBR\StarterPack\Livewire\Pages\Auth\Forms\LoginForm;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

class LoginPage extends Component
{
    public LoginForm $form;

    public bool $successModal = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->successModal = true;

        $this->redirectIntended(default: route('dashboard.index', absolute: false), navigate: true);
    }

    #[Layout('starter-pack::components.layouts.auth')]
    public function render(): View
    {
        return view('starter-pack::livewire.pages.auth.login-page');
    }
}
