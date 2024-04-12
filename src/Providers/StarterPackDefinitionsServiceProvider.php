<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\Providers;

use ArtisanBR\StarterPack\Policies\PermissionPolicy;
use ArtisanBR\StarterPack\Policies\RolePolicy;
use ArtisanBR\StarterPack\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use TallStackUi\Facades\TallStackUi;

class StarterPackDefinitionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->definePolicies();
        $this->defineMacros();

        //$this->customizeTheme();
    }

    public function defineMacros(): void
    {

        //Vite
        Vite::macro('image', function (string $asset, ?string $namespace = null) {

            if (empty($namespace)) {

                $mediaPath = config('starter-pack.resources.media.path');

                return $this->asset("{$mediaPath}/images/{$asset}");
            }

            return $this->asset("{$namespace}/{$asset}");
        });
    }

    public static function customizeTheme()
    {
        //TallStack Customization:
        TallStackUi::personalize()
            ->form('input')
            ->block([
                'input.wrapper'          => 'flex',
                'input.color.base'       => 'input input-primary w-full h-14',
                'input.color.background' => 'bg-transparent',
            ]);

    }

    public function definePolicies(): void
    {
        //User
        Gate::policy(config('auth.providers.users.model', 'ArtisanBR\StarterPack\Models\User'), UserPolicy::class);
        //Role
        Gate::policy(config('permission.models.role', 'ArtisanBR\StarterPack\Models\Role'), RolePolicy::class);
        //Permissions
        Gate::policy(config('permission.models.permission', 'ArtisanBR\StarterPack\Models\Permission'), PermissionPolicy::class);
    }
}
