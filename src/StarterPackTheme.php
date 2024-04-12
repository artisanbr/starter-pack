<?php

namespace ArtisanBR\StarterPack;

use Illuminate\Support\Fluent;

/**
 * @method dashboard
 * @method dashboardLight
 * @method dashboardDark
 * @method auth
 * @method authLight
 * @method authDark
 */
class StarterPackTheme
{
    public function moduleConfig(string $module = 'dashboard'): array
    {
        return once(fn () => config("starter-pack.{$module}.themes", []));
    }

    public function themeConfig(string $module = 'dashboard', bool $darkMode = false): array
    {
        return $this->moduleConfig($module)[$darkMode ? 'dark' : 'light'] ?? [];
    }

    public function module(string $moduleName = 'dashboard', bool $darkMode = false): Fluent
    {
        //Return module only if theme is null
        return fluent($this->themeConfig($moduleName, $darkMode));
    }

    public function themeSection($section, string $moduleName = 'dashboard', bool $darkMode = false): Fluent
    {
        //Return module only if theme is null
        return fluent($this->module($moduleName, $darkMode)->get($section));
    }

    public function getProperty($section, $property, string $moduleName = 'dashboard', bool $darkMode = false): Fluent
    {
        //Return module only if theme is null
        return $this->themeSection($section, $moduleName, $darkMode)->get($property);
    }

    public function classFromArray($data, $darkMode = false): string
    {
        return collect($data)->filter()->map(fn ($value, $property) => match ($property) {
            'bg-color'   => ($darkMode ? 'dark:' : '')."bg-{$value}",
            'text-color' => ($darkMode ? 'dark:' : '')."text-{$value}",
            'class'      => str($value)->explode(' ')->filter()->map(fn ($class) => ($darkMode ? 'dark:' : '').$class)->implode(' '),
        })->join(' ');
    }

    public function sectionClass($section, string $moduleName = 'dashboard'): string
    {
        $themeSectionLight = $this->themeSection($section, $moduleName)->toArray() ?? [];
        $themeSectionDark = $this->themeSection($section, $moduleName, true)->toArray() ?? [];

        $lightClasses = $this->classFromArray($themeSectionLight);
        $darkClasses = $this->classFromArray($themeSectionDark, true);

        return $lightClasses.' '.$darkClasses;
    }

    /**
     * Se algum metodo que não existe for invocado tentará encontrar um tema no formato moduloTemaPropriedade
     */
    public function __call($name, $arguments)
    {
        $snakeName = str($name)->snake('.');

        $moduleName = $snakeName->explode('.')[0];

        $themeName = $snakeName->explode('.')[1] ?? null;

        if ($snakeName->contains('.')) {
            $fluentArguments = collect($snakeName->explode('.'))->except(0, 1)->implode('.');
        } else {
            $fluentArguments = null;
        }

        if ($this->moduleConfig($moduleName)) {

            return ! blank($fluentArguments) ? $this->themeSection($fluentArguments, $moduleName, $themeName) : $this->module($moduleName, $themeName);
        }
    }
}
