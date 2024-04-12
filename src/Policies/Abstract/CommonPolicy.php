<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Policies\Abstract;

use ArtisanBR\StarterPack\Models\User;

abstract class CommonPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($this->isRoot($user)) {
            return true;
        }

        return null;
    }

    public function isRoot(User $user): bool
    {
        return $user->hasRole(['root']);
    }

    public function isAdmin(User $user): bool
    {
        return $user->hasRole(['admin']);
    }

    public function isMod(User $user): bool
    {
        return $user->hasRole(['mod']);
    }

    public function isUser(User $user): bool
    {
        return $user->hasRole(['user']);
    }

    public function isGuest(User $user): bool
    {
        return $user->hasRole(['guest']);
    }
}
