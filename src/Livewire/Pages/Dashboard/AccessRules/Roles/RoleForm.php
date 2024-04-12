<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Livewire\Pages\Dashboard\AccessRules\Roles;

use Livewire\Attributes\Validate;
use Livewire\Form;

class RoleForm extends Form
{
    public ?int $id = null;

    #[Validate('required|string')]
    public string $name = '';

    #[Validate('nullable|required|string')]
    public ?string $display_name = '';

    #[Validate('nullable|tring')]
    public ?string $description = '';

    public array $permissions = [];
}
