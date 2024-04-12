<?php

namespace ArtisanBR\StarterPack\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ArtisanBR\StarterPack\StarterPack
 */
class StarterPackTheme extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \ArtisanBR\StarterPack\StarterPackTheme::class;
    }
}
