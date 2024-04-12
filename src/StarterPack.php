<?php

namespace ArtisanBR\StarterPack;

use JetBrains\PhpStorm\ArrayShape;

class StarterPack
{
    //region Domains
    #[ArrayShape(['app' => 'string', 'dashboard' => 'string'])]
    public function domains(): array
    {
        $appDomain = config('starter-pack.app.domain', '');
        $dashboardSubdomain = config('starter-pack.dashboard.subdomain', null);

        return [
            'app'       => $appDomain,
            'dashboard' => ($dashboardSubdomain ? $dashboardSubdomain.'.' : '').$appDomain,
        ];
    }

    public function domain($service = 'app'): string
    {
        return $this->domains()[$service] ?? '';
    }

    public function appDomain(): string
    {
        return $this->domain();
    }

    public function dashboardDomain(): string
    {
        return $this->domain('dashboard');
    }
    //endregion

    //region Media

    //endregion

    //region Views
    public function viewPath(string $view): string
    {
        return config('starter-pack.views.namespace').'::'.$view;
    }
    //endregion
}
