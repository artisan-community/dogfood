<?php

namespace ArtisanBuild\Till\Providers;

use Illuminate\Support\ServiceProvider;

class TillServiceProvider extends ServiceProvider
{
    #[\Override]
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/till.php', 'till');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/till.php' => config_path('till.php'),
        ], 'till');
    }
}
