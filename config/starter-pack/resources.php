<?php

// config for StarterPack/StarterPack
use ArtisanBR\StarterPack\Livewire\Pages\Auth\LoginPage;
use ArtisanBR\StarterPack\Livewire\Pages\Dashboard\AccessRules\Permissions\ListPermissions;
use ArtisanBR\StarterPack\Livewire\Pages\Dashboard\AccessRules\Roles\ListRoles;
use ArtisanBR\StarterPack\Livewire\Pages\Dashboard\Users\CreateUser;
use ArtisanBR\StarterPack\Livewire\Pages\Dashboard\Users\EditUser;
use ArtisanBR\StarterPack\Livewire\Pages\Dashboard\Users\ListUser;
use ArtisanBR\StarterPack\Livewire\Pages\Dashboard\Users\ShowUser;
use ArtisanBR\StarterPack\View\Components\PasswordGenerator;

return [

    'media' => [
        'path' => env('SP_MEDIA_PATH', 'vendor/artisanbr/starter-pack/resources/media'),

        'images' => [
            //From 'media.path'/
            'path' => env('SP_MEDIA_IMAGE_PATH', 'images'),

            //From 'media.image.path'/
            'logo'          => env('SP_MEDIA_IMAGE_LOGO', 'logos/logo-dark.webp'),
            'logo_darkmode' => env('SP_MEDIA_IMAGE_LOGO_DARKMODE', 'logos/logo-light.webp'),
            'icon'          => env('SP_MEDIA_IMAGE_ICON', 'icon.webp'),
        ],

    ],

    'views' => [
        'namespace' => env('SP_VIEWS_NAMESPACE', 'sp'),
    ],

    'components' => [
        'prefix' => env('SP_COMPONENTS_PREFIX', 'sp-'),
        'blade'  => [
            'password-generator' => PasswordGenerator::class,
        ],
        'livewire' => [
            //Components

            //Pages

            //Auth
            'auth.login-page' => LoginPage::class,

            //Users
            'dashboard.users.list'   => ListUser::class,
            'dashboard.users.create' => CreateUser::class,
            'dashboard.users.edit'   => EditUser::class,
            'dashboard.users.show'   => ShowUser::class,

            //Access Rules
            'dashboard.access-rules.roles.list'       => ListRoles::class,
            'dashboard.access-rules.permissions.list' => ListPermissions::class,
        ],
    ],
];
