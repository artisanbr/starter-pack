<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected function color(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => config('access-rules.role_color.'.$attributes['name'], 'primary'),
        );
    }
}
