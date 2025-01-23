<?php

namespace ArtisanBuild\FluxThemes\Theme;

use ArtisanBuild\FluxThemes\Contracts\LoadsHeaderRightNavbarItems;
use ArtisanBuild\FluxThemes\Enums\NavbarItemTypes;

class LoadHeaderRightNavbarItems implements LoadsHeaderRightNavbarItems
{
    public function __invoke(): array
    {
        return auth()->check() ? $this->user() : $this->guest();
    }

    protected function user(): array
    {
        return [
            [
                'type' => NavbarItemTypes::NavbarItem->value,
                'href' => route('login'),
                'text' => 'Log In',
                'icon' => null,
                'target' => null,
            ],
            [
                'type' => NavbarItemTypes::NavbarItem->value,
                'href' => route('register'),
                'text' => 'Register',
                'icon' => null,
                'target' => null,
            ],
            [
                'type' => NavbarItemTypes::BladeComponent->value,
                'component' => 'flux-themes::dark-mode-selector-compact',
                'params' => [],
            ],
        ];
    }

    protected function guest(): array
    {
        return [
            [
                'type' => 'navbar-item',
                'href' => route('login'),
                'text' => 'Log In',
                'icon' => null,
                'target' => null,
            ],
            [
                'type' => 'navbar-item',
                'href' => route('register'),
                'text' => 'Register',
                'icon' => null,
                'target' => null,
            ],
            [
                'type' => 'blade-component',
                'component' => 'flux-themes::dark-mode-selector-compact',
                'params' => [],
            ],
        ];
    }
}
