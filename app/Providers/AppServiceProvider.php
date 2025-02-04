<?php

namespace App\Providers;

use App\Listeners\VerbsEventListener;
use ArtisanBuild\Verbstream\Adverbs\VerbsEvent;
use Illuminate\Support\ServiceProvider;
use Override;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    #[Override]
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
