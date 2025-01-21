<?php

use ArtisanBuild\FluxThemes\Actions\WriteToAppCss;
use ArtisanBuild\FluxThemes\Enums\Colors;
use ArtisanBuild\FluxThemes\Theme;
use Illuminate\Support\Facades\File;

pest()->beforeEach(function () {
    File::put(__DIR__.'/files/app.css', File::get(__DIR__.'/files/app.css.original'));
});

describe('it writes the correct content to a file that does not have any colors defined', function () {
    it('writes_the_default_theme', function () {
        app(WriteToAppCss::class)(new Theme(__DIR__.'/files/app.css'));

        expect(trim(File::get(__DIR__.'/files/app.css')))->toBe(trim(File::get(__DIR__.'/files/default_theme.css')));

    });

    it('writes_the_red_theme', function () {
        $theme = new Theme(__DIR__.'/files/app.css');

        $theme = Colors::Red->set($theme);

        app(WriteToAppCss::class)($theme);

        expect(trim(File::get(__DIR__.'/files/app.css')))->toBe(trim(File::get(__DIR__.'/files/red_theme.css')));

    });

    describe('it correctly replaces content when swapping themes', function () {
        it('goes from default to red', function () {
            app(WriteToAppCss::class)(new Theme(__DIR__.'/files/app.css'));

            expect(trim(File::get(__DIR__.'/files/app.css')))->toBe(trim(File::get(__DIR__.'/files/default_theme.css')));

            $theme = new Theme(__DIR__.'/files/app.css');

            $theme = Colors::Red->set($theme);

            app(WriteToAppCss::class)($theme);

            expect(File::get(__DIR__.'/files/app.css'))->toBeIgnoringWhitespace(File::get(__DIR__.'/files/red_theme.css'));
        });
    });
});
