<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Repositories\AccessRules;

use ArtisanBR\AbstractTallCrud\Repositories\AbstractModelRepository;
use ArtisanBR\StarterPack\Models\Permission;

class PermissionRepository extends AbstractModelRepository
{
    public string $modelClass = Permission::class;

    /**
     * @param  Permission  $model
     */
    public function afterSave(array $data, $model): Permission
    {

        if (! blank($data['roles'] ?? null)) {
            $model->syncRoles($data['roles']);
        }

        return $model;
    }
}
