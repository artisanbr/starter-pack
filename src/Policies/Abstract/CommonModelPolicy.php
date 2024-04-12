<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Policies\Abstract;

use ArtisanBR\StarterPack\Models\User;
use Illuminate\Database\Eloquent\Model;

abstract class CommonModelPolicy extends CommonPolicy
{
    public string $model = '';

    public function getPermissionFor(string $action, User $user, ?Model $model = null): bool
    {
        if ($model && ($model->user_id ?? null) == $user->id) {
            return true;
        }

        return $this->isAdmin($user) || $user->hasPermissionTo("$action {$this->model}");
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->getPermissionFor('list', $user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Model $model): bool
    {
        return $this->getPermissionFor(__FUNCTION__, $user, $model);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->getPermissionFor(__FUNCTION__, $user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Model $model): bool
    {
        return $this->getPermissionFor(__FUNCTION__, $user, $model);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Model $model): bool
    {
        return $this->getPermissionFor(__FUNCTION__, $user, $model);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Model $model): bool
    {
        return $this->getPermissionFor(__FUNCTION__, $user, $model);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Model $model): bool
    {
        return $this->getPermissionFor(__FUNCTION__, $user, $model);
    }
}
