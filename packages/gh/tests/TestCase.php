<?php

declare(strict_types=1);

namespace ArtisanBuild\GH\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return ['ArtisanBuild\GH\Providers\GHServiceProvider'];
    }
}
