<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\View\Components;

use ArtisanBR\StarterPack\Facades\MenuBuilder as MenuBuilderEngine;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Symfony\Component\Uid\Ulid;

class MenuBuilder extends Component
{
    public string $menuRender = '';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $name,
        public ?bool $autoActive = false,
        public ?bool $horizontal = false,
        public array $items = [],
    ) {
        if (blank($this->name)) {
            $this->name = Ulid::generate();
        } elseif (! $this->items) {
            $this->items = config("starter-pack.dashboard.menus.{$this->name}", []);

        }

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        //$this->menuRender = \ArtisanBR\StarterPack\Facades\MenuBuilder::render($this->items, $this->attributes);

        return function (array $data) {
            // $data['componentName'];
            // $data['attributes'];
            // $data['slot'];

            $attributes = ($data['attributes'] ?? new ComponentAttributeBag())->class([
                'menu-horizontal' => $this->horizontal,
            ])->merge([
                'id' => $this->name. ($this->horizontal ? '-horizontal' : '').'-menu',
            ]);


            $menuRender = MenuBuilderEngine::render($this->items, $attributes->getAttributes(), $this->autoActive);

            return <<<blade
<div>
    $menuRender
</div>
blade;
        };

    }
}
