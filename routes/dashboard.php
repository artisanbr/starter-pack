<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

use ArtisanBR\StarterPack\Facades\StarterPack;
use ArtisanBR\StarterPack\Livewire\Pages\Dashboard\AccessRules\Permissions\ListPermissions;
use ArtisanBR\StarterPack\Livewire\Pages\Dashboard\AccessRules\Roles\ListRoles;
use ArtisanBR\StarterPack\Livewire\Pages\Dashboard\DashboardIndex;
use ArtisanBR\StarterPack\Livewire\Pages\Dashboard\Users\CreateUser;
use ArtisanBR\StarterPack\Livewire\Pages\Dashboard\Users\EditUser;
use ArtisanBR\StarterPack\Livewire\Pages\Dashboard\Users\ListUser;
use ArtisanBR\StarterPack\Livewire\Pages\Dashboard\Users\ShowUser;
use Illuminate\Support\Facades\Route;

Route::domain(StarterPack::dashboardDomain())
    ->middleware(['auth:web'])
    ->name('dashboard.')
    ->group(function () {
        //Volt::route('/maryui', 'users.index')->middleware('auth:web');

        Route::get('/', DashboardIndex::class)->name('index');
        //Users
        Route::name('users.')
            ->prefix('users')
            ->group(function () {
                Route::get('/', ListUser::class)->name('index');
                Route::get('/create', CreateUser::class)->name('create');
                Route::get('/{user}', ShowUser::class)->name('show');
                Route::get('/{user}/edit', EditUser::class)->name('edit');
            });

        //Access Rules
        Route::name('access-rules.')
            ->prefix('access-rules')
            ->group(function () {
                Route::name('roles.')
                    ->prefix('roles')
                    ->group(function () {
                        Route::get('/', ListRoles::class)->name('index');
                    });

                Route::name('permissions.')
                    ->prefix('permissions')
                    ->group(function () {
                        Route::get('/', ListPermissions::class)->name('index');
                    });
            });
    });
