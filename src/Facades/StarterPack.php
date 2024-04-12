<?php

namespace ArtisanBR\StarterPack\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ArtisanBR\StarterPack\StarterPack
 */
class StarterPack extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \ArtisanBR\StarterPack\StarterPack::class;
    }
}
