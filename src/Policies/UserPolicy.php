<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Policies;

use ArtisanBR\StarterPack\Policies\Abstract\CommonModelPolicy;

class UserPolicy extends CommonModelPolicy
{
    public string $model = 'users';
}
