<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Repositories\AccessRules;

use ArtisanBR\AbstractTallCrud\Repositories\AbstractModelRepository;
use ArtisanBR\StarterPack\Models\Role;

class RoleRepository extends AbstractModelRepository
{
    public string $modelClass = Role::class;

    /**
     * @param  Role  $model
     */
    public function afterSave(array $data, $model): Role
    {

        if (! blank($data['permissions'] ?? null)) {
            $model->syncPermissions($data['permissions']);
        }

        return $model;
    }
}
