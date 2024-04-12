<?php

namespace ArtisanBR\StarterPack;

use ArtisanBR\StarterPack\Enums\MenuItemType;
use ArtisanBR\StarterPack\MenuBuilder\MenuRenderObject;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

class MenuBuilder
{
    protected UrlGenerator $urlGenerator;

    protected Request $request;

    protected bool $autoActiveItems = false;

    public function __construct(UrlGenerator $urlGenerator, Request $request)
    {
        $this->urlGenerator = $urlGenerator;
        $this->request = $request;

        //dd($this->urlGenerator->current(), $this->urlGenerator->to(route('dashboard.users.index')), $this->urlGenerator->to('/users'));
    }

    public function itemComponent(array $item): object
    {

        return new class($item, $this->autoActiveItems) extends MenuRenderObject
        {
            public ?string $title = null;

            public ?string $icon = null;

            public ?string $link = null;

            public ?bool $external = false;

            public ?bool $noWireNavigate = false;

            public ?string $badge = null;

            public ?string $badgeClasses = null;

            public ?bool $separator = false;

            public function __construct(array $menuItem, bool $autoActive = false)
            {
                $this->itemData = $menuItem;

                $this->roles = $menuItem['roles'] ?? $menuItem['role'] ?? $menuItem['r'] ?? null;
                $this->permissions = $menuItem['permissions'] ?? $menuItem['permission'] ?? $menuItem['p'] ?? null;

                $this->type = MenuItemType::from($menuItem['type'] ?? $menuItem['t'] ?? 'item');

                $this->title = $menuItem['text'] ?? $menuItem['title'] ?? $menuItem['label'] ?? null;
                $this->icon = $menuItem['icon'] ?? $menuItem['i'] ?? null;
                $this->link = $menuItem['link'] ?? $menuItem['url'] ?? $menuItem['route'] ?? null;
                $this->badge = $menuItem['badge'] ?? $menuItem['b'] ?? null;
                $this->badgeClasses = $menuItem['badge-classes'] ?? $menuItem['bc'] ?? null;
                $this->separator = $menuItem['separator'] ?? $menuItem['s'] ?? false;
                $this->noWireNavigate = $menuItem['no-wire'] ?? false;
                $this->external = $menuItem['external'] ?? $menuItem['e'] ?? false;

                if ($this->link && Route::has($this->link)) {
                    $this->link = route($this->link);
                }

                $this->active = $autoActive ? $this->isActive() : false;
            }

            public function allowed(): bool
            {
                if (($this->roles && ! auth()->user()->hasAnyRole($this->roles)) ||
                    ($this->permissions && ! auth()->user()->hasAnyPermission($this->permissions))) {
                    return false;
                }

                return true;
            }

            public function isActive(): bool
            {
                return $this->link ? Facades\MenuBuilder::isActiveUrl($this->link) : false;
            }

            public function render(): string
            {
                if (! $this->allowed()) {
                    return '';
                }

                $attributes = collect([
                    'title'          => $this->title,
                    'icon'           => $this->icon,
                    'link'           => $this->link,
                    'external'       => $this->external,
                    'noWireNavigate' => $this->noWireNavigate,
                    'badge'          => $this->badge,
                    'badgeClasses'   => $this->badgeClasses,
                    'separator'      => $this->separator,
                    'active'         => $this->active ?: null,
                ]);

                $htmlAttributes = $attributes->filter()->reduce(fn ($carry, $value, $key) => $carry.$key.'="'.$value.'" ');

                return "<x-menu-item $htmlAttributes />";
            }
        };
    }

    public function isActiveUrl(string $url): bool
    {

        //If is a route name, return route url
        if (! str($url)->contains('/') && Route::has($url)) {
            $url = route($url);
        }

        return $this->urlGenerator->current() == $this->urlGenerator->to($url) || $this->request->is($url);
    }

    public function render(string|array $menu = '', ?array $attributes = [], bool $autoActive = false): string
    {
        $this->autoActiveItems = $autoActive;


        if (is_string($menu)) {
            $menu = config("starter-pack.dashboard.menus.{$menu}", []);
        }

        if (is_array($menu)) {

            $attributesString = collect($attributes ?? [])->filter()->reduce(fn ($carry, $value, $key) => $carry.$key.'="'.$value.'" ');

            $outputBlade = "<x-menu $attributesString>";

            foreach ($menu as $item) {
                $outputBlade .= $this->renderAny($item);
            }

            $outputBlade .= '</x-menu>';

            return Blade::render($outputBlade);

        }

        return __('Erro ao renderizar o menu');
    }

    protected function renderAny(array $item): string
    {
        return match ($item['type'] ?? 'item') {
            'submenu' => $this->renderSubmenu($item),
            default   => $this->renderItem($item),
        };
    }

    protected function renderItem(array $menuItem): string
    {

        $itemComponent = $this->itemComponent($menuItem);

        return $itemComponent->render();

    }

    protected function renderSubmenu(array $submenu): string
    {

        $submenuAttrs = collect([
            'title' => $submenu['text'] ?? $submenu['title'] ?? $submenu['label'] ?? null,
            'icon'  => $submenu['icon'] ?? $submenu['i'] ?? null,
        ])->filter()->reduce(fn ($carry, $value, $key) => $carry.$key.'="'.$value.'" ');

        $outputBlade = "<x-menu-sub $submenuAttrs>";

        foreach ($submenu['items'] ?? [] as $subitem) {
            $outputBlade .= $this->renderAny($subitem);
        }

        $outputBlade .= '</x-menu-sub>';

        return $outputBlade;
    }
}
