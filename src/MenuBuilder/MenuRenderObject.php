<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\MenuBuilder;

use ArtisanBR\StarterPack\Enums\MenuItemType;

abstract class MenuRenderObject
{
    public array $itemData = [];

    public string|array|null $roles = null;

    public string|array|null $permissions = null;

    public bool $active = false;

    public MenuItemType $type = MenuItemType::Item;
}
