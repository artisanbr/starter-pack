<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Policies;

use ArtisanBR\StarterPack\Models\Permission;
use ArtisanBR\StarterPack\Models\User;
use ArtisanBR\StarterPack\Policies\Abstract\CommonModelPolicy;

class PermissionPolicy extends CommonModelPolicy
{
    public string $model = 'permissions';

    public function assign(User $user, Permission $model): bool
    {
        return $this->getPermissionFor(__FUNCTION__, $user, $model);
    }

    public function unassign(User $user, Permission $model): bool
    {
        return $this->getPermissionFor(__FUNCTION__, $user, $model);
    }
}
