<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Filters;

use ArtisanBR\AbstractTallCrud\Filters\AbstractCrudFilter;
use ArtisanBR\StarterPack\Models\Role;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PermissionTableFilter extends AbstractCrudFilter
{
    public function __construct(
        public array $permissions = [],
        public ?Carbon $created_from = null,
        public ?Carbon $created_until = null,
    ) {

        $this->created_from = $this->created_from ?? now()->subYear();
        $this->created_until = $this->created_until ?? now();
    }

    public function roleList(): array
    {
        return Role::all()->map(fn ($role) => [
            'id'   => $role->name,
            'name' => $role->display_name,
        ])->toArray();
    }

    public function applyPermissionsFilter(Builder $builder): Builder
    {
        return $builder->whereHas('permissions', function (Builder $query) {
            $query->whereIn('name', $this->permissions);
        });
    }

    public function applyCreatedFromFilter(Builder $builder): Builder
    {
        return $builder->whereDate('created_at', '>=', $this->created_from);
    }

    public function applyCreatedUntilFilter(Builder $builder): Builder
    {
        return $builder->whereDate('created_at', '<=', $this->created_until);
    }
}
