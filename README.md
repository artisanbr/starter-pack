# Laravel TALL Starter Pack

[![Latest Version on Packagist](https://img.shields.io/packagist/v/artisanbr/starter-pack.svg?style=flat-square)](https://packagist.org/packages/artisanbr/starter-pack)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/artisanbr/starter-pack/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/artisanbr/starter-pack/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/artisanbr/starter-pack/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/artisanbr/starter-pack/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/artisanbr/starter-pack.svg?style=flat-square)](https://packagist.org/packages/artisanbr/starter-pack)

Laravel TALL StarterPack provides an Dashboard boilerplate with Users, Rules and Permissions Management using Laravel
11, Livewire 3, Tailwind, MaryUI, TallStackUi and mutch more!

## Installation

First, you can install the Fortify, Mary UI and TallStack UI packages:

**Fortify**

https://laravel.com/docs/11.x/fortify

**Mary UI (without prefix)**

https://mary-ui.com/docs/installation

**TallStack ui (With 'ts' prefix)**

https://tallstackui.com/docs/installation

First, you can install the package via composer:

```bash
composer require artisanbr/starter-pack
```

Now edit the `vite.config.js` file:

```javascript
import {defineConfig} from 'vite';
import laravel, {refreshPaths} from 'laravel-vite-plugin';

export default defineConfig({
    //Sail Server Perk (Remove the "server" key if you dont use Sail / Containers)
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost'
        },
    },
    //Laravel:
    plugins: [
        laravel({
            input: [
                //StarterPack
                'vendor/artisanbr/starter-pack/resources/css/starter-pack.css', //Add this
                'vendor/artisanbr/starter-pack/resources/js/starter-pack.js', //Add this
                //Laravel
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            //Refresh Perk (default = refresh: true), remove if you dont mind to use yarn/npm run "dev"
            refresh: [
                ...refreshPaths,
                'app/Livewire/**', //Laravel 11 pattern
                'app/Http/Livewire/**', //Laravel <= 10 pattern
                //StarterPack
                'vendor/artisanbr/starter-pack/src/Livewire/**',
                'vendor/artisanbr/starter-pack/src/Http/Livewire/**',
                //Other vendors or paths bellow:
            ],
        }),
        //...
    ],
    //...
});

```

This wil set the Starter Pack JS and CSS to be built on Vite commands

Then edit the `tailwind.config.js` file and add the presets:

```javascript
//...
presets: [
    //TallStack UI
    require('./vendor/tallstackui/tallstackui/tailwind.config.js'),
    //StarterPack
    require('./vendor/artisanbr/starter-pack/tailwind.config.js') //Add This
],
    content
:
[
    // You will probably also need these lines
    "./resources/**/**/*.blade.php",
    "./resources/**/**/*.js",
    "./app/View/Components/**/**/*.php",
    "./app/Livewire/**/**/*.php",

    //StarterPack and Dependency's
    "./vendor/artisanbr/starter-pack/src/**/*.php", //Add This
    "./vendor/artisanbr/starter-pack/resources/views/*.blade.php", //Add This

    // Add mary
    "./vendor/robsontenorio/mary/src/View/Components/**/*.php",
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',

    //TallStack UI
    './vendor/tallstackui/tallstackui/src/**/*.php',
]
//...
```

This will define stater pack (mary ui + tallstack ui + tailwind) `tailwind.config.js` to be the default tailwind config,
so you can override wha you want on your application `tailwind.config.js` file

Now add the Extra Providers to `bootstrap/providers.php` file:

```php
//...
return [
    App\Providers\AppServiceProvider::class,
    //... Other Providers
    \ArtisanBR\StarterPack\Providers\StarterPackDefinitionsServiceProvider::class, //Add This
]
//...

```

This wil add some perks on Laravel Definitions, like "Vite::image"

Optionally, you can change livewire default layout to use StarterPack Dashboard editing `config/livewire.php` file

```php
return [
//..
    /*
    |---------------------------------------------------------------------------
    | Layout
    |---------------------------------------------------------------------------
    | The view that will be used as the layout when rendering a single component
    | as an entire page via `Route::get('/post/create', CreatePost::class);`.
    | In this case, the view returned by CreatePost will render into $slot.
    |
    */

    'layout' => 'sp::components.layouts.dashboard', //Replace here
    
//..
];
```

If you want to use the css/js assets on your own "layout structure", you can add the starter pack files to `@vite` on
your `<head>`

```bladehtml

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    <link rel="icon" type="image/webp" href="{{ Vite::image('icon.webp') }}">d ar   

    <tallstackui:script/>
    @livewireStyles
    @vite([
    'resources/css/app.css',
    'resources/js/app.js',
    //StarterPack
    'vendor/artisanbr/starter-pack/resources/css/starter-pack.css', //Add this
    'vendor/artisanbr/starter-pack/resources/js/starter-pack.js' //Add this
    ])
    @stack('css')
</head>

```

You Done!!

### Next Steps:

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="starter-pack-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="starter-pack-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="starter-pack-views"
```

## Usage

Open your Dashboard domain (subdomain + app domain), ex: [http://dashboard.myapp.test](http://dashboard.myapp.test)

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Renalcio Carlos Jr.](https://github.com/artisanbr)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
