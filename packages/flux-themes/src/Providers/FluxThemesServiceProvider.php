<?php

namespace ArtisanBuild\FluxThemes\Providers;

use ArtisanBuild\FluxThemes\Commands\SetThemeCommand;
use Illuminate\Support\ServiceProvider;

class FluxThemesServiceProvider extends ServiceProvider
{
    #[\Override]
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/flux-themes.php', 'flux-themes');

        $this->commands([
            SetThemeCommand::class,
        ]);
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/flux-themes.php' => config_path('flux-themes.php'),
        ], 'flux-themes');
    }
}
