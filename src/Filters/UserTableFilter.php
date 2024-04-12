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

class UserTableFilter extends AbstractCrudFilter
{
    /*protected $fillable = [
        'roles',
        'created_from', //start
        'created_until', //End
    ];

    protected $casts = [
        'roles'         => 'array',
        'created_from'  => 'datetime',
        'created_until' => 'datetime',
    ];

    protected $attributes = [
        'roles'         => [],
        'created_from'  => null,
        'created_until' => null,
    ];*/

    /*
        protected function getCreatedFromAttribute()
        {
            return $this->attributes['created_from'] ?? now()->subYear();
        }

        protected function getCreatedUntilAttribute()
        {
            return $this->attributes['created_until'] ?? now();
        }*/

    public function __construct(
        public array $roles = [],
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

    public function applyRolesFilter(Builder $builder): Builder
    {
        return $builder->whereHas('roles', function (Builder $query) {
            $query->whereIn('name', $this->roles);
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
