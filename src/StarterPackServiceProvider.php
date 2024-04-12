<?php

namespace ArtisanBR\StarterPack;

use ArtisanBR\StarterPack\Foundation\Support\BladeComponentPrefix;
use ArtisanBR\StarterPack\Providers\StarterPackDefinitionsServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class StarterPackServiceProvider extends ServiceProvider
{
    private string $config_path = __DIR__.'/../config/';

    private string $routes_path = __DIR__.'/../routes/';

    private string $resources_path = __DIR__.'/../resources/';

    private string $views_path = __DIR__.'/../resources/views/';

    public function register(): void
    {
        $this->registerConfigs();

        // Get the AliasLoader instance
        $loader = AliasLoader::getInstance();
        foreach (config('starter-pack.app.aliases', []) as $alias => $class) {
            // Add your aliases
            $loader->alias($alias, $class);
        }

    }

    public function registerConfigs(): void
    {
        //Configs
        foreach (File::allFiles($this->config_path) as $file) {

            if ($file->isFile() && $file->getExtension() === 'php') {
                $relativePathName = str($file->getRelativePathname())->replace('/', '.');

                $relativePathName = $relativePathName->replace('.php', '');

                $this->mergeConfigFrom(
                    $file->getPathname(), $relativePathName->toString()
                );
            }

        }
    }

    public function boot(): void
    {
        $this->bootRoutes();
        $this->bootViews();
        $this->bootComponents();

    }

    public function bootRoutes(): void
    {
        $this->loadRoutesFrom($this->routes_path.'web.php');
    }

    public function bootViews(): void
    {
        $this->loadViewsFrom($this->views_path, 'starter-pack');
        $this->loadViewsFrom($this->views_path, 'artisan-b-r.starter-pack');
        $this->loadViewsFrom($this->views_path, config('starter-pack.resources.views.namespace'));
        //$this->loadViewsFrom($this->views_path, 'artisan-b-r.starter-pack');

        /* Livewire::component('auth.login-page', LoginPage::class);*/

    }

    protected function bootComponents(): void
    {
        $prefix = app(BladeComponentPrefix::class);
        //Blade
        foreach (config('starter-pack.resources.components.blade', []) as $alias => $class) {
            Blade::component($alias, $class, 'starter-pack');
            Blade::component($class, $prefix($alias));
        }

        Blade::anonymousComponentPath($this->views_path.'components', 'starter-pack');
        Blade::anonymousComponentPath($this->views_path.'components', config('starter-pack.resources.views.namespace'));

        Blade::componentNamespace('ArtisanBR\StarterPack\Livewire', 'starter-pack');
        Blade::componentNamespace('ArtisanBR\StarterPack\Livewire', config('starter-pack.resources.views.namespace'));

        Blade::componentNamespace('ArtisanBR\StarterPack\View\Components', 'starter-pack');
        Blade::componentNamespace('ArtisanBR\StarterPack\View\Components', config('starter-pack.resources.views.namespace'));

        //Livewire

        foreach (config('starter-pack.resources.components.livewire') as $alias => $class) {
            Livewire::component("starter-pack-{$alias}", $class);
            Livewire::component($prefix($alias), $class);
        }

        /*Volt::mount([
            $this->views_path.'components/volt',
            $this->views_path.'livewire',
            //config('livewire.view_path', resource_path('views/livewire')), resource_path('views/pages'),
        ]);*/

    }

    /*public function provides()
    {
        return [
            StarterPackDefinitionsServiceProvider::class,
        ];
    }*/

    public static function appBoot()
    {
        StarterPackDefinitionsServiceProvider::customizeTheme();

    }
}
