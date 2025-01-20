<?php

use ArtisanBuild\FluxThemes\Theme;

it('writes the gray to a config if nothing exists yet', function() {
    app(\ArtisanBuild\FluxThemes\Actions\WriteToTailwindConfig::class)(new Theme(tailwind_config: __DIR__ . '/files/tailwind.config.js'), \ArtisanBuild\FluxThemes\Enums\Grays::Slate);
});

it('replaces the gray in the config if one already exists')->todo();

it('removes the gray in the config if the default is selected')->todo();
