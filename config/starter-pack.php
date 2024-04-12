<?php

// config for StarterPack/StarterPack
use ArtisanBR\StarterPack\Facades\MenuBuilder;
use ArtisanBR\StarterPack\Facades\StarterPackTheme;
use ArtisanBR\StarterPack\View\Components\Layouts\Dashboard;

return [

    'app' => [
        'domain' => env('SP_APP_DOMAIN', env('APP_DOMAIN', 'artisan.test')),
        'aliases' => [
            'MenuBuilder' => MenuBuilder::class,
            'StarterPackTheme' => StarterPackTheme::class,
        ]
    ],

    'dashboard' => [
        'subdomain' => env('SP_DASHBOARD_SUBDOMAIN', 'dashboard'),
        'prefix'    => env('SP_DASHBOARD_PREFIX', ''),
    ],
];
