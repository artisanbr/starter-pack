<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

use Illuminate\Support\Facades\Route;


Route::middleware(['web'])
    ->group(function () {
        require 'auth.php';
        require 'dashboard.php';
    });
