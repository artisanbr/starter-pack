<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Enums;

use ArtisanBR\Goodies\Enums\Traits\EnumBase;

enum MenuItemType: string{
    use EnumBase;

    case Item = 'item';
    case Submenu = 'submenu';
    case Separator = 'separator';
    case Header = 'header';
}
