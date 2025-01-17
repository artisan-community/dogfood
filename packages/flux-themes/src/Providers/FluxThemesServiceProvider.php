<?php

namespace ArtisanBuild\FluxThemes\Providers;

use Illuminate\Support\ServiceProvider;

class FluxThemesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/flux-themes.php', 'flux-themes');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/flux-themes.php' => config_path('flux-themes.php'),
        ], 'flux-themes');
    }
}
