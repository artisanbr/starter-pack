<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Repositories;

use ArtisanBR\AbstractTallCrud\Repositories\AbstractModelRepository;
use ArtisanBR\StarterPack\Models\User;

class UserRepository extends AbstractModelRepository
{
    public string $modelClass = User::class;

    /**
     * @param  User  $model
     */
    public function afterSave(array $data, $model): User
    {
        if (isset($data['roles'])) {
            $model->syncRoles($data['roles']);
        }

        if (! $model->hasAnyRole(['root', 'admin', 'mod', 'user'])) {
            $model->assignRole('user');
        }

        return $model;
    }
}
