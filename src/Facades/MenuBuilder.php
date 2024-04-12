<?php

namespace ArtisanBR\StarterPack\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ArtisanBR\StarterPack\StarterPack
 */
class MenuBuilder extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \ArtisanBR\StarterPack\MenuBuilder::class;
    }
}
