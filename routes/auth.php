<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

use ArtisanBR\StarterPack\Livewire\Pages\Auth\LoginPage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::name('auth.')->group(function () {
    Route::get('login', LoginPage::class)
        ->name('login');

    Route::get('logout', function (Request $request): RedirectResponse {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('auth.login'));
    })
        ->middleware('auth:web')
        ->name('logout');
})->middleware(['web']);

//Auth Aliases
Route::get('sign-in', fn () => redirect(route('auth.login')))
    ->name('login')
    ->middleware(['guest:web']);
