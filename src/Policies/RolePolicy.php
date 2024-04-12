<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Policies;

use ArtisanBR\StarterPack\Models\Role;
use ArtisanBR\StarterPack\Models\User;
use ArtisanBR\StarterPack\Policies\Abstract\CommonModelPolicy;

class RolePolicy extends CommonModelPolicy
{
    public string $model = 'roles';

    public function assign(User $user, Role $model): bool
    {
        return $this->getPermissionFor(__FUNCTION__, $user, $model);
    }

    public function unassign(User $user, Role $model): bool
    {
        return $this->getPermissionFor(__FUNCTION__, $user, $model);
    }
}
